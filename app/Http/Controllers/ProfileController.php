<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Symfony\Contracts\Service\Attribute\Required;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function showProfile(): View
    {
        if(auth()->user()->status == 'mahasiswa'){
            $profile = DB::table('view_profile_mahasiswa')
                ->select('*')
                ->where('email', Auth::user()->email)
                ->get();
            $profile = $profile[0];
        }else{
            $profile = DB::table('view_profile_dosen')
                ->select('*')
                ->where('email', Auth::user()->email)
                ->get();
            $profile = $profile[0];
        }

        $profile->jenis_kelamin == 'L' ? $profile->jenis_kelamin = 'Laki-laki' : $profile->jenis_kelamin = 'Perempuan';

        return view('profile', compact('profile'));
    }

    public function editProfile()
    {
        return view('edit-profile');
    }
    
    public function updateProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if(
            $request->username == $user->username &&
            $request->email == $user->email
        ){
            return back()->with('failed', 'Gagal update, tidak ada perubahan');
        }

        $rules = [];

        if($request->username != $user->username){
            $rules['username'] = ['required', 'string', 'max:255', 'unique:users'];
        }

        if($request->email != $user->email){
            $rules['email'] = 'required|string|lowercase|email|max:255|unique:'.User::class.'';
        }

        $validatedData = $request->validate($rules);
        
        if($request->email != $user->email){
            $validatedData['email_verified_at'] = NULL;
        }

        User::where('id', $user->id)->update($validatedData);

        event(new Registered(User::find($user->id)));
        
        return back()->with('success', 'Profile berhasil diubah');
    }
    
    public function editPassword()
    {
        return view('edit-password');
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', 'same:confirm_password', 'min:1'],
            'confirm_password' => ['required', 'same:new_password', 'min:1']
        ]);

        $user = User::find(auth()->user()->id);
        if(Hash::check($request->old_password, $user->password)){
            if($request->new_password == $request->old_password){
                return back()->with('failed', 'Gagal update password, tidak ada perubahan pada password');
            }

            User::where('id', auth()->user()->id)->update([
                'password' => bcrypt($request->new_password)
            ]);

            return back()->with('success', 'Password berhasil diubah');
        }

        return back()->with('failed', 'Gagal update password, password lama salah');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}