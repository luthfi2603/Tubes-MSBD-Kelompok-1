<?php

namespace App\Http\Controllers;

use App\Models\JenisTulisan;
use App\Models\Prodi;
use Illuminate\Http\Request;

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
        return view('index', compact('jenisTulisan', 'prodis'));
    }
}