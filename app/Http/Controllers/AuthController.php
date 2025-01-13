<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Cek peran pengguna
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }
            if ($user->hasRole('saksi')) {
                return redirect()->route('saksi.home');
            }
            if ($user->hasRole('operator')) {
                if (!$user->hasProfile($user->id)) {
                    return redirect()->route('profile.create');
                }
                return redirect()->route('operator.home');
            }
        }
        
        return redirect('login')->with('error', 'Email atau password salah!');
    }
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string|max:255',
            'kecamatan_id' => 'required|integer|exists:kecamatans,id',
        ]); 
        
        // Membuat operator baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => 2, // operator
        ]);

        DB::table('user_profiles')->insert([
            'user_id' =>$user->id,
            'username' => $request->username,
            'password' => $request->password,
            'nama' => $request->nama,
            'nomor_hp' => $request->nomor_hp ?? '',
            'alamat' => $request->alamat ?? '',
            'kecamatan_id' => $request->kecamatan_id,
            'role' => 'operator',
        ]);
        
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
    
    public function registerSaksi(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string|max:255',
            'kecamatan_id' => 'required|integer|exists:kecamatans,id',
        ]); 
        
        // Membuat saksi baru
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => $user->id,
            'role_id' => 3, // saksi
        ]);
        
        DB::table('user_profiles')->insert([
            'user_id' =>$user->id,
            'username' => $request->username,
            'password' => $request->password,
            'nama' => $request->nama,
            'nomor_hp' => $request->nomor_hp ?? '',
            'alamat' => $request->alamat ?? '',
            'kecamatan_id' => $request->kecamatan_id,
            'role' => 'saksi',
        ]);
        
        return back()->with('success', 'Berhasil menambah saksi!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
