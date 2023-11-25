<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
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
            try {
                $user = DB::select('call create_user(?, ?, ?, ?, ?)', array($request->username, $request->email, $password, $request->nim_nip, 1));
            } catch (\Throwable $th) {

            }
            
    
            // event(new Registered($user));
    
            // Auth::login($user);
    
            return redirect(RouteServiceProvider::HOME);
        }else{
            
        }
    }
}
