<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        // if(Auth::check()){
        //     return redirect('home');
        // }
        return view('auth.login');
    }

    public function registration()
    {
        // if(Auth::check()){
        //     return redirect('home');
        // }
        return view('auth.registration');
    }

    public function loginProcess(Request $request)  // Proses login
    {        
        $request->validate([
        'email' => 'required',
        'password' => 'required',
    ], [
        'email.required' => 'Email atau Username Tidak Boleh Kosong',
        'password.required' => 'NIK Tidak Boleh Kosong',
     ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }
        return redirect('login')->with('error' , 'Email atau password salah.');
    }

    public function registrationProcess(Request $request)  // Proses register
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Ambil semua gambar di folder public/profile
        $avatars = File::files(public_path('profile'));

        // Pilih avatar secara acak
        if (count($avatars) > 0) {
            // Pilih avatar secara acak dari folder profile
            $randomAvatar = $avatars[array_rand($avatars)]->getFilename();
            $data['avatar'] = $randomAvatar;
        } else {
            // Jika tidak ada gambar, pilih avatar default
            $data['avatar'] = 'Profile.png';
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if (!$user) {
            return redirect('registration')->with('error' , 'Username atau Email telah digunakan');
        }
        return redirect('login')->with('success' , 'Registrasi berhasil. Silahkan login untuk masuk ke aplikasi');
    }


    public function logout()  // Proses logout
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

}
