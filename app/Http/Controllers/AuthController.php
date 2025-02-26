<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    /**
     * Display the Add Admin form.
     *
     * @return \Illuminate\View\View
     */
    public function showAddAdminForm()
    {
        return view('Auth.AddStaff');
    }

    /**
     * Display the Add Karyawan form.
     *
     * @return \Illuminate\View\View
     */
    public function showAddKaryawanForm()
    {
        return view('Auth.AddKaryawan');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'hrd') {
                return redirect()->intended('/hrd/dashboard');
            } else {
                return redirect()->intended('/karyawan/dashboard');
            }
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle the logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Add a new Karyawan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addKaryawan(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'karyawan',
            'alamat' => $validated['alamat'],
            'no_telp' => $validated['no_telp'],
        ]);

        Session::flash('success', 'Karyawan berhasil ditambahkan!');

        return redirect()->route('admin.addKaryawanForm');
    }

    /**
     * Add a new Admin or HRD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,hrd',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->back()->with('success', ucfirst($request->role) . ' berhasil ditambahkan.');
    }

    public function karyawanIndex()
    {
        $karyawans = User::where('role', 'karyawan')->get();

        return view('admin.karyawanIndex', compact('karyawans'));
    }
}
