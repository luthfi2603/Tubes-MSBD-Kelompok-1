<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\DatabaseManager;

class SuperAdminController extends Controller {
    public function index(){
        session()->forget('wasRefreshed');
        
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
    public function showStatus(){
        $statuss = Status::paginate(10);
        return view('super-admin.kelola-status', compact('statuss'));
    }
    public function createStatus(){
        return view('super-admin.input-status');
    }
    public function storeStatus(Request $request){
        // dd($request->request);
        $request->validate([
            'nama_status' => ['required', 'unique:statuses', 'max:20'],
            'tingkat' => ['required']            
        ]);

        $status = new Status;
        $status->nama_status = $request->nama_status;
        $status->status = $request->tingkat;

        $status->save();

        return back()->with('success', 'Status berhasil ditambahkan');
    }
    public function editStatus($status){
        $estatus = Status::find($status);

        return view('super-admin.edit-status', compact('estatus'));
    }
    public function updateStatus(Request $request, $status){
        $estatus = Status::find($status);
        // dd($estatus->status, $request->tingkat);
        if(
            $estatus->nama_status === $request->nama_status &&
            $estatus->status === $request->tingkat
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        $rules = [
            'tingkat' => ['required']
        ];

        if($estatus->nama_status != $request->nama_status){
            $rules['nama_status'] = ['required', 'unique:statuses', 'max:20'];
        }

        $request->validate($rules);

        $estatus->nama_status = $request->nama_status;
        $estatus->status = $request->tingkat;

        $estatus->save();

        return redirect()->route('status.kelola')->with('success', 'status berhasil diubah');
    }
    public function destroyStatus($status){
        $dstatus = Status::find($status);

        try {
            $dstatus->delete();
    
            return back()->with('success', 'Status berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Status ini sedang digunakan, penghapusan tidak dapat dilakukan');
        }
    }
    public function destroyPegawai(Request $request){
        DB::select('call deleteAdmin(?, ?)', array($request->id_pegawai, $request->id_user));
        return back()->with('success', 'Data admin berhasil dihapus');
    }
}