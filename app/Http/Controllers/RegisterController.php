<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'min:1', 'max:30', 'unique:users'],
            'status' => ['required'],
            'nim_nip' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:1'],
            'konfirmasi_password' => ['required', 'same:password', 'min:1'],
        ]);

        $password = Hash::make($request->password);

        if($request->status == 'mahasiswa'){
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 1));
            }catch(\Throwable $th){
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }elseif($request->status == 'dosen'){
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 2));
            } catch (\Throwable $th) {
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }

        event(new Registered(User::latest()->first()));

        return redirect('/login')->with('success', 'Registrasi akun berhasil');
    }
}