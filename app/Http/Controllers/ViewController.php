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
        $penulis = DB::table('view_list_karya')
            ->select('judul', 'penulis')
            ->get();

        return view('index', compact('jenisTulisans', 'prodis', 'karyas', 'penulis'));
    }
}