<?php

namespace App\Http\Controllers;

use App\Models\Rig;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RigController extends Controller
{
    // Menampilkan list rakitan milik user yang sedang login
    public function index()
    {
        $rigs = Rig::where('user_id', Auth::id())->with('components')->latest()->get();
        return view('rigs.index', compact('rigs'));
    }

    // Proses membuat Rig kosong baru
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $rig = Rig::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('rigs.show', $rig->id);
    }

    // Menampilkan detail item rakitan di dalam Rig beserta total kalkulasi harga & watt
    public function show($id)
    {
        $rig = Rig::where('user_id', Auth::id())->with('components')->findOrFail($id);
        
        $totalPrice = 0;
        $totalWattage = 0;

        foreach ($rig->components as $component) {
            $totalPrice += $component->price * $component->pivot->quantity;
            $totalWattage += $component->wattage * $component->pivot->quantity;
        }

        return view('rigs.show', compact('rig', 'totalPrice', 'totalWattage'));
    }

    // Menambahkan komponen ke dalam Rig rakitan (Tabel Pivot component_rig)
    public function addComponent(Request $request, $rigId)
    {
        $rig = Rig::where('user_id', Auth::id())->findOrFail($rigId);
        
        // Pasang atau update quantity jika komponen sudah ada di keranjang rakitan
        $rig->components()->syncWithoutDetaching([
            $request->component_id => ['quantity' => $request->get('quantity', 1)]
        ]);

        return back()->with('success', 'Komponen berhasil dimasukkan ke rakitan!');
    }
}