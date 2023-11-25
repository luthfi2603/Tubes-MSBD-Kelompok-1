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
            'password' => ['required', 'same:konfirmasi_password'],
            'konfirmasi_password' => ['required', 'same:password'],
        ]);
        // dd($request->all());

        // if($request->status == 'dosen'){
        //     $user = User::create([
        //         'username' => $request->username,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password)
        //     ]);
        $password = Hash::make($request->password);

        if($request->status == 'mahasiswa'){
            DB::select('call create_user(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 1));
        }elseif($request->status == 'dosen'){
            DB::select('call create_user(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 2));
        }
        return redirect('/login2')->with('success', 'registrasi akun berhasil');
    }
}
