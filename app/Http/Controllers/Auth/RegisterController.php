<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return auth()->user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.catalog');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|min:3|max:40',
            'email'    => ['required','string','email','unique:users,email','regex:/^[a-zA-Z0-9._%+\-]+@gmail\.com$/'],
            'password' => 'required|string|min:6|max:12|confirmed',
            'phone'    => ['required','string','regex:/^08[0-9]{7,12}$/'],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'name.min'           => 'Nama minimal 3 huruf.',
            'name.max'           => 'Nama maksimal 40 huruf.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah terdaftar.',
            'email.regex'        => 'Email harus menggunakan domain @gmail.com.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.max'       => 'Password maksimal 12 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'phone.required'     => 'Nomor HP wajib diisi.',
            'phone.regex'        => 'Nomor HP harus diawali 08 dan terdiri 9-14 digit.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'user',
        ]);

        auth()->login($user);
        return redirect()->route('user.catalog')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }
}
