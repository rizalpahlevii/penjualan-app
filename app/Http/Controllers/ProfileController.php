<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("pages.profile.index", compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => [
                'required', Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'email' => [
                'required', Rule::unique('users')->ignore(Auth::user()->id)
            ],
        ]);
        $user = User::find(Auth::user()->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($user->save()) {
            session()->flash('message', 'Profil berhasil diubah!');
            return redirect()->route('profile.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Profil gagal diubah!');
            return redirect()->route('profile.index')->with('status', 'danger');
        }
    }
    public function password()
    {
        return view("pages.profile.password");
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:5',
            'password' => 'required_with:password_confirmation|string|confirmed|min:5'
        ]);
        $userData = Auth::user();
        if (Hash::check($request->old_password, $userData->password)) {
            $user = User::find($userData->id);
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                session()->flash('message', 'Password berhasil diubah!');
                return redirect()->route('profile.password')->with('status', 'success');
            } else {
                session()->flash('message', 'Password gagal diubah!');
                return redirect()->route('profile.password')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Password lama salah!');
            return redirect()->route('profile.password')->with('status', 'danger');
        }
    }
}
