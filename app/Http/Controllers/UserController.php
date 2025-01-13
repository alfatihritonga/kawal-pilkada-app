<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\UserTps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function saksiHome()
    {
        return view('saksi.home');
    }

    public function createProfile()
    {
        return view('auth.profile');
    }
    
    public function storeProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string|max:255',
            'kecamatan_id' => 'required|integer|exists:kecamatans,id',
        ]);
        
        UserProfile::create([
            'user_id' => auth()->id(),
            'username' => '',
            'password' => '',
            'nama' => $request->nama,
            'nomor_hp' => $request->nomor_hp ?? '',
            'alamat' => $request->alamat ?? '',
            'kecamatan_id' => $request->kecamatan_id,
            'role' => '',
        ]);

        return redirect()->route('operator.home');
    }
}
