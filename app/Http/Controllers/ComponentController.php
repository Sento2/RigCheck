<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    // Menampilkan semua list komponen PC
    public function index(Request $request)
    {
        // Fitur filter kategori (cpu, gpu, ram, dll)
        $query = Component::query();
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $components = $query->latest()->get();
        return view('components.index', compact('components'));
    }

    // Mengambil detail komponen (untuk ajax/modal spesifikasi JSON)
    public function show($id)
    {
        $component = Component::findOrFail($id);
        return response()->json($component);
    }

    // Simpan komponen baru (Fitur Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max::255',
            'category' => 'required|in:cpu,gpu,ram,storage,motherboard,psu,base_system',
            'price' => 'required|numeric',
            'wattage' => 'required|numeric',
            'spesifikasi' => 'nullable|array' // Disimpan otomatis sebagai JSON berkat casting model
        ]);

        Component::create($validated);
        return back()->with('success', 'Komponen berhasil ditambah, bro!');
    }

    public function builder()
    {
        // Tarik semua komponen dan kelompokkan berdasarkan kategori
        $components = Component::all()->groupBy('category');
        
        // Lempar ke tampilan builder (tempat kamu menaruh desain Stitch AI)
        return view('pages.rigs.builder', compact('components'));
    }

}