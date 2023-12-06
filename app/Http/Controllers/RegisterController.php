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
            'username' => ['required', 'min:5', 'max:15', 'unique:users'],
            'status' => ['required'],
            'nim_nidn' => ['required', 'min:9', 'max:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ]);

        $password = Hash::make($request->password);

        if($request->status == 'mahasiswa'){
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nidn, 1));
            }catch(\Throwable $th){
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }else{
            try {
                DB::select('call createUser(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nidn, 2));
            } catch (\Throwable $th) {
                return back()->with('failed', 'NIM/NIDN tidak terdaftar atau anda telah memiliki akun');
            }
        }

        event(new Registered(User::latest()->first()));

        return redirect('/login')->with('success', 'Registrasi akun berhasil');
    }
}