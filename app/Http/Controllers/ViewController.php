<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
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

        return view('/detail-karya-tulis', compact('detail', 'kataKunci', 'penulis', 'pembimbing', 'kontributor'));
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
        $karyas = DB::table('view_list_karya')
            ->select('id')
            ->where('kode_prodi', $prodi)
            ->groupBy('id')
            ->get();

        $result = KaryaTulis::get();

        $idsToFilter = $karyas->pluck('id')->toArray();
        $karyas = $result->whereIn('id', $idsToFilter);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();

        $prodi = Prodi::where('kode_prodi', $prodi)->get();
        $prodi = $prodi[0]->nama_prodi;

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
}
