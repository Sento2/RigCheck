<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Rig;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Tampilkan Admin Command Center.
     */
    public function index(): View|RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses tidak diizinkan.');
        }

        return view('pages.admin.index', [
            'totalComponents'  => Component::count(),
            'totalUsers'       => User::count(),
            'totalRigs'        => Rig::count(),
            'latestComponents' => Component::latest()->take(10)->get(),
        ]);
    }

    /**
     * Simpan hardware baru ke katalog.
     */
    public function storeHardware(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'category' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'wattage'  => 'required|numeric|min:0',
            'socket'   => 'nullable|string',
            'chipset'  => 'nullable|string',
            'ram_type' => 'nullable|string',
            'capacity' => 'nullable|string',
        ]);

        $spesifikasi = array_filter([
            'socket'   => $request->socket,
            'chipset'  => $request->chipset,
            'ram_type' => $request->ram_type,
            'capacity' => $request->capacity,
        ]);

        Component::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'wattage'     => $request->wattage,
            'spesifikasi' => $spesifikasi,
        ]);

        return back()->with('success', 'Hardware baru berhasil ditambahkan ke katalog!');
    }
}