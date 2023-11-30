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
        if(auth()->user()){
            if(auth()->user()->email_verified_at == NULL){
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
        
        return view('single-ebook', compact('ebooks'));
    }

    public function detailEBook($id){
        $ebook = Ebook::where('id', $id)->get();

        $ebook = $ebook[0];

        return view('detail-ebook', compact('ebook'));
    }

    public function showKoleksi($jenisTulisan){
        $karyas = KaryaTulis::where('jenis', $jenisTulisan)->paginate(5);

        $penuliss = DB::table('view_list_karya')
            ->select('penulis', 'id')
            ->get();
        
        return view('koleksi', compact('karyas', 'penuliss', 'jenisTulisan'));
    }
}