<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\DatabaseManager;

class SuperAdminController extends Controller {
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
            'username' => ['required', 'min:5', 'max:15', 'unique:users', 'regex:/^[^\s]+$/'],
            'nama' => ['required', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:8'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8']
        ], ['username.regex' => 'Username tidak boleh mengandung spasi.']);

        $password = Hash::make($request->password);

        DB::select('call createAdmin(?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nama));
        
        event(new Registered(User::latest()->first()));

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

        $rules = [
            'nama' => ['required', 'max:255']
        ];

        if($request->username != $user->username){
            $rules['username'] = ['required', 'min:5', 'max:15', 'unique:users', 'regex:/^[^\s]+$/'];
        }
        if($request->email != $user->email){
            $rules['email'] = ['required', 'string', 'max:255', 'unique:users', 'lowercase', 'email'];
            $verifikasi = 1;
        }else{
            $verifikasi = 0;
        }

        $request->validate($rules, ['username.regex' => 'Username tidak boleh mengandung spasi.']);

        DB::select('call updateAdmin(?, ?, ?, ?, ?, ?)', array($request->username, $request->email, $verifikasi, $request->nama, $idp, $idu));

        event(new Registered(User::find($idu)));
        
        return redirect()->route('pegawai.kelola')->with('success', 'Data admin berhasil diubah');
    }
    public function destroyPegawai(Request $request){
        DB::select('call deleteAdmin(?, ?)', array($request->id_pegawai, $request->id_user));
        return back()->with('success', 'Data admin berhasil dihapus');
    }
}