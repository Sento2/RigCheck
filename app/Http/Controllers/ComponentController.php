<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Rig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ComponentController extends Controller
{
    /**
     * Tampilkan semua komponen (dengan opsional filter kategori).
     */
    public function index(Request $request): View
    {
        $components = Component::query()
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->latest()
            ->get();

        return view('components.index', compact('components'));
    }

    /**
     * Kembalikan detail komponen sebagai JSON.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Component::findOrFail($id));
    }

    /**
     * Simpan komponen baru (admin).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:cpu,gpu,ram,storage,motherboard,psu,base_system',
            'price'       => 'required|numeric',
            'wattage'     => 'required|numeric',
            'spesifikasi' => 'nullable|array',
        ]);

        Component::create($validated);

        return back()->with('success', 'Komponen berhasil ditambahkan!');
    }

    /**
     * Tampilkan halaman builder dengan daftar komponen terkelompok.
     */
    public function builder(Request $request): View
    {
        $components = Component::query()
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->get()
            ->groupBy('category');

        $currentRig = auth()->check()
            ? Rig::where('user_id', auth()->id())->where('is_completed', false)->first()
            : null;

        return view('pages.rigs.builder', compact('components', 'currentRig'));
    }
}