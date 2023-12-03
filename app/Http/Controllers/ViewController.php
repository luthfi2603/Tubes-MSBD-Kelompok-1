<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Favorite;
use App\Models\Prodi;
use App\Models\JenisTulisan;
use App\Models\KaryaTulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index(){
        if (auth()->user()) {
            if (auth()->user()->email_verified_at == NULL) {
                return redirect('/verify-email');
            }
        }
        $jenisTulisans = JenisTulisan::all();
        $prodis = Prodi::all();
        $karyas = KaryaTulis::paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
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

        $isLiked = Favorite::where('user_id', auth()->user()->id)
            ->where('karya_id', $id)
            ->get()
            ->isEmpty();

        $detail = DB::table('view_detail_karya_tulis')
            ->select('*')
            ->where('id', $id)
            ->first();
        
        $penulis = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'penulis')
            ->groupBy('kontributor', 'status')
            ->get();
        
        $pembimbing = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'pembimbing')
            ->groupBy('kontributor', 'status')
            ->get();
        
        $kontributor = DB::table('view_detail_karya_tulis')
            ->select('kontributor', 'status')
            ->where('id', $id)
            ->where('status', 'kontributor')
            ->groupBy('kontributor', 'status')
            ->get();

        $kataKuncis = DB::table('view_detail_karya_tulis')
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
        $ebook = Ebook::where('id', $id)->get();

        $ebook = $ebook[0];

        return view('detail-e-book', compact('ebook'));
    }

    public function showByKoleksi($jenisTulisan){
        $karyas = KaryaTulis::where('jenis', $jenisTulisan)->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();
        
        return view('koleksi', compact('karyas', 'penuliss', 'jenisTulisan'));
    }

    public function showByProdi($prodi){
        $karyaIds = DB::table('view_list_karya')
            ->select('id')
            ->where('kode_prodi', $prodi)
            ->groupBy('id')
            ->pluck('id');
    
        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);
    
        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();
    
        $prodi = Prodi::where('kode_prodi', $prodi)->first()->nama_prodi;
    
        return view('prodi', compact('karyas', 'prodi', 'penuliss'));
    }
    
    public function showByAuthor($author){
        $karyas = DB::table('view_list_karya')
            ->select('*')
            ->where('penulis', $author)
            ->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        return view('author', compact('karyas', 'author', 'penuliss'));
    }

    public function viewAdvSearch(){
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();

        return view('advanced-search', compact('prodis', 'jenisTulisans'));
    }

    public function search(Request $request){
        $prodis = Prodi::all();
        $jenisTulisans = JenisTulisan::all();

        $search = $request->input('search');
        $results = DB::table('view_detail_karya_tulis')
            ->where('judul', 'like', '%' . $search . '%')
            ->orWhere('kontributor', 'like', '%' . $search . '%')
            ->orWhere('kata_kunci', 'like', '%' . $search . '%')
            ->select('*')
            ->paginate(5);

        return view('search-page', compact('results', 'prodis', 'jenisTulisans'));
    }

    public function showFavorite(){
        $karyaIds = Favorite::select('karya_id')
            ->where('user_id', auth()->user()->id)
            ->pluck('karya_id');

        $karyas = KaryaTulis::whereIn('id', $karyaIds)->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
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