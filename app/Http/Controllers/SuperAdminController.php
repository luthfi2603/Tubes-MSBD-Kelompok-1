<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index(){
        return view('super-admin.super-admin-home');
    }

    public function showPegawai(){
        $pegawais = DB::table('view_pegawai_user')->paginate(10);
        return view('super-admin.kelola-pegawai', compact('pegawais'));
    }
    public function createPegawai(){
        return view('super-admin.input-pegawai');
    }
    public function storePegawai(Request $request){
    
        $request->validate([
            'username' => ['required', 'min:1', 'max:30', 'unique:users'],
            'nama' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:1'],
            'konfirmasi_password' => ['required', 'same:password', 'min:1']
        ]);

        $password = Hash::make($request->password);

        DB::select('call createAdmin(?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nama));
        
        return back()->with('success', 'Data admin berhasil ditambahkan');
    }
    public function editPegawai($idp, $idu){
        $pegawai = Admin::find($idp);
        $akun = User::find($idu);
        return view('super-admin.edit-pegawai', compact('pegawai', 'akun'));
    }
    public function updatePegawai(Request $request, $idp, $idu){
        $pegawai = Admin::find($idp);
        $user = User::find($idu);
        if(
            $request->username == $user->username &&
            $request->email == $user->email &&
            $request->nama == $pegawai->nama
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }
        $rules = [];

        if($request->username != $user->username){
            $request->validate([
                'username' => ['required', 'string', 'max:255', 'unique:users']
            ]);
        }
        if($request->email != $user->email){
            $request->validate([
                'email' => ['required', 'string', 'max:255', 'unique:users', 'lowercase', 'email']
            ]);
            $verifikasi = 1;
        }else{
            $verifikasi = 0;
        }

        DB::select('call updateAdmin(?, ?, ?, ?, ?, ?)', array($request->username, $request->email, $verifikasi, $request->nama, $idp, $idu));
        
        return redirect()->route('pegawai.kelola')->with('success', 'Data admin berhasil diedit');
    }
    public function destroyPegawai(Request $request){
        DB::select('call deleteAdmin(?, ?)', array($request->id_pegawai, $request->id_user));
        return back()->with('success', 'Data admin berhasil dihapus');
    }
}
