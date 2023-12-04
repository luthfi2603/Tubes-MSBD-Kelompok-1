<?php

namespace App\Http\Controllers;

use App\Models\BidangIlmu;
use App\Models\Ebook;
use App\Models\Favorite;
use App\Models\Prodi;
use App\Models\JenisTulisan;
use App\Models\KaryaTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller {
    public function index(){
        if (auth()->user()) {
            if (auth()->user()->email_verified_at == NULL) {
                return redirect('/verify-email');
            }
        }
        $jenisTulisans = JenisTulisan::all();
        $prodis = Prodi::all();
        $karyas = KaryaTulis::paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('index', compact('jenisTulisans', 'prodis', 'karyas', 'penuliss'));
    }

    public function detailKaryaTulis($id){
        $view = KaryaTulis::select('view')
            ->where('id', $id)
            ->first()
            ->view;
        $view += 1;
        KaryaTulis::where('id', $id)->update(['view' => $view]);

        if(auth()->user()){
            $isLiked = Favorite::where('user_id', auth()->user()->id)
                ->where('karya_id', $id)
                ->get()
                ->isEmpty();
        }else{
            $isLiked = true;
        }

        $detail = DB::table('view_karya_tulis')
            ->select('*')
            ->where('id', $id)
            ->first();

        $penulis = DB::table('view_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'status')
            ->get();

        $pembimbing = DB::table('view_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'pembimbing')
            ->groupBy('kontributor', 'status')
            ->get();

        $kontributor = DB::table('view_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'kontributor')
            ->groupBy('kontributor', 'status')
            ->get();

        $kataKuncis = DB::table('view_karya_tulis')
            ->select('kata_kunci')
            ->where('id', $id)
            ->groupBy('kata_kunci')
            ->get();

        $kataKunci = "";
        foreach ($kataKuncis as $key) {
            $kataKunci .= $key->kata_kunci . ', ';
        }
        $kataKunci = rtrim($kataKunci, ', ');

        return view('detail-karya-tulis', compact('detail', 'kataKunci', 'penulis', 'pembimbing', 'kontributor', 'isLiked'));
    }

    public function showEBook(){
        $ebooks = Ebook::paginate(5);

        return view('e-book', compact('ebooks'));
    }

    public function detailEBook($id){
        $view = Ebook::select('view')
            ->where('id', $id)
            ->first()
            ->view;
        $view += 1;
        Ebook::where('id', $id)->update(['view' => $view]);

        $ebook = Ebook::where('id', $id)->first();

        return view('detail-e-book', compact('ebook'));
    }

    public function showByKoleksi($jenisTulisan){
        $karyas = KaryaTulis::where('jenis', $jenisTulisan)->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('koleksi', compact('karyas', 'penuliss', 'jenisTulisan'));
    }

    public function showByProdi($prodi){
        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('kode_prodi', $prodi)
            ->groupBy('id')
            ->pluck('id');
    
        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);
    
        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();
    
        $prodi = Prodi::where('kode_prodi', $prodi)->first()->nama_prodi;
    
        return view('prodi', compact('karyas', 'prodi', 'penuliss'));
    }

    public function showByAuthor($author){
        $karyaIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where('kontributor', $author)
            ->where('status', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        return view('author', compact('karyas', 'author', 'penuliss'));
    }

    public function viewAdvSearch(Request $request){
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $search1 = $request->input('search1');
        $search2 = $request->input('search2');
        $search3 = $request->input('search3');

        $select1 = $request->input('select1');
        $select2 = $request->input('select2');
        $select3 = $request->input('select3');

        $query1 = $request->input('query1');
        $query2 = $request->input('query2');

        $tahunawal = $request->input('tahunawal');
        $tahunakhir = $request->input('tahunakhir');

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->where(function ($query) use ($select1, $search1, $select2, $search2, $select3, $search3, $query1, $query2) {
                $query->where($select1, 'LIKE', '%' . $search1 . '%')
                    ->where('status', '=', 'penulis');

                // Menggunakan $query1
                if ($query1 === 'OR') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->orWhere(function ($subquery) use ($select2, $search2, $select3, $search3, $query2) {
                            $subquery->where($select2, 'LIKE', '%' . $search2 . '%')
                                ->orWhere($select3, 'LIKE', '%' . $search3 . '%', $query2);
                        });
                    }
                } elseif ($query1 === 'AND') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->where($select2, 'LIKE', '%' . $search2 . '%')
                            ->where($select3, 'LIKE', '%' . $search3 . '%', $query2);
                    }
                } elseif ($query1 === 'AND NOT') {
                    if (!empty($select2) || !empty($search2) || !empty($select3) || !empty($search3) || !empty($query2)) {
                        $query->where($select2, 'LIKE', '%' . $search2 . '%', $query1)
                            ->where($select3, 'LIKE', '%' . $search3 . '%', $query2);
                    }
                }
            })
            ->orWhereBetween('tahun', [$tahunawal, $tahunakhir])
            ->groupBy('id')
            ->pluck('id');

        $results = KaryaTulis::whereIn('id', $resultIds)->paginate(5);

        return view('search-page', compact('prodis', 'jenisTulisans',  'penuliss', 'results', 'bidIlmus'));
    }

    public function showAdvSearch(){
        return view('advanced-search');
    }

    public function search(Request $request){
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();
        $bidIlmus = BidangIlmu::all();
        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();

        $search = $request->input('search');

        $resultIds = DB::table('view_karya_tulis')
            ->select('id')
            ->orWhere(function ($query) use ($search) {
                $query->where('judul', 'LIKE', '%' . $search . '%')
                    ->orWhere('kontributor', 'LIKE', '%' . $search . '%')
                    ->orWhere('kata_kunci', 'LIKE', '%' . $search . '%');
            })
            ->where('status', '=', 'penulis')
            ->groupBy('id')
            ->pluck('id');

        $results = KaryaTulis::whereIn('id', $resultIds)->paginate(5);

        return view('search-page', compact('results', 'prodis', 'jenisTulisans', 'penuliss', 'bidIlmus'));
    }

    public function showFavorite(){
        $karyaIds = Favorite::select('karya_id')
            ->where('user_id', auth()->user()->id)
            ->pluck('karya_id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);

        $penuliss = DB::table('view_karya_tulis')
            ->select('kontributor', 'id')
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'id')
            ->get();
    
        return view('favorite', compact('karyas', 'penuliss'));
    }

    public function storeFavorite(Request $request){
        Favorite::create([
            'user_id' => auth()->user()->id,
            'karya_id' => $request->karya_id
        ]);

        return back()->with('success', 'Berhasil ditambahkan ke favorite');
    }

    public function destroyFavorite(Request $request){
        Favorite::where('user_id', auth()->user()->id)
            ->where('karya_id', $request->karya_id)
            ->delete();
        
        return back()->with('success', 'Berhasil dihapus dari favorite');
    }
}