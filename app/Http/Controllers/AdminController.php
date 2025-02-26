<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $totalKaryawan = User::where('role', 'karyawan')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        $penilaian = Penilaian::orderBy('kedisiplinan', 'desc')
            ->orderBy('sikap_kerja', 'desc')
            ->orderBy('kinerja', 'desc')
            ->orderBy('keahlian', 'desc')
            ->orderBy('total_nilai', 'desc')
            ->limit(5)
            ->get(['id', 'user_id', 'kedisiplinan', 'sikap_kerja', 'kinerja', 'keahlian', 'total_nilai']);

        return view('admin.dashboard', compact('totalKaryawan', 'totalAdmin', 'penilaian'));
    }

    public function adminProfile(){
        $user = auth()->user();

        return view('admin.Profile', compact('user'));
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek apakah password lama sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function adminProfileEdit()
    {
        $user = Auth::user();
        return view('admin.Profile', compact('user'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
