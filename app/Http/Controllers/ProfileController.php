<?php

namespace App\Http\Controllers;

use App\Models\Rig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna.
     */
    public function index(): View
    {
        $user      = User::query()->findOrFail(Auth::id());
        $totalRigs = Rig::where('user_id', $user->id)->count();

        return view('pages.profile.index', compact('user', 'totalRigs'));
    }

    /**
     * Perbarui informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::query()->findOrFail(Auth::id());

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Informasi profil berhasil diperbarui.');
    }

    /**
     * Perbarui kata sandi pengguna.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user           = User::query()->findOrFail(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Kata sandi berhasil diubah.');
    }
}
