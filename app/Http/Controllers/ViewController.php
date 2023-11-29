<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\JenisTulisan;
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
        $karyas = DB::table('view_list_karya')
            ->select('*')
            ->paginate(5);

        return view('index', compact('jenisTulisans', 'prodis', 'karyas'));
    }

    public function detailKaryaTulis($id){
        $detail = DB::table('view_detail_karya_tulis')
            ->select('*')
            ->where('id', $id)
            ->first();
        
        $kontributors = DB::table('view_detail_karya_tulis')
            ->select('kontributor')
            ->where('id', $id)
            ->groupBy('kontributor')
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

        return view('/detail-karya-tulis', compact('detail', 'kontributors', 'kataKunci'));
    }
}