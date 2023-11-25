<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:3', 'max:30', 'unique:users'],
            'status' => ['required'],
            'nim_nip' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:8'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8'],
        ]);

        $password = Hash::make($request->password);

        if($request->status == 'mahasiswa'){
            try {
                DB::select('call create_user(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 1));
            }catch(\Throwable $th){
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }elseif($request->status == 'dosen'){
            try {
                DB::select('call create_user(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 2));
            } catch (\Throwable $th) {
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }
        return redirect('/login2')->with('success', 'Registrasi akun berhasil');
    }
}