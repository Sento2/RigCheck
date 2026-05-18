<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Rig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RigController extends Controller
{
    /**
     * Tampilkan daftar rakitan milik pengguna yang login.
     */
    public function index(): View
    {
        $rigs = Rig::where('user_id', Auth::id())
            ->with('components')
            ->latest()
            ->get();

        return view('pages.admin.dashboard', compact('rigs'));
    }

    /**
     * Buat rakitan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => 'required|string|max:255']);

        $rig = Rig::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
        ]);

        return redirect()->route('rigs.show', $rig->id);
    }

    /**
     * Tampilkan detail rakitan beserta kalkulasi total.
     */
    public function show(int $id): View
    {
        $rig = Rig::where('user_id', Auth::id())
            ->with('components')
            ->findOrFail($id);

        $totalPrice   = $rig->components->sum(fn ($c) => $c->price * $c->pivot->quantity);
        $totalWattage = $rig->components->sum(fn ($c) => $c->wattage * $c->pivot->quantity);

        return view('rigs.show', compact('rig', 'totalPrice', 'totalWattage'));
    }

    /**
     * Tambahkan komponen ke keranjang rakitan aktif.
     */
    public function addComponent(Request $request): RedirectResponse
    {
        $request->validate([
            'component_id' => 'required|exists:components,id',
        ]);

        $rig = Rig::firstOrCreate(
            ['user_id' => Auth::id(), 'is_completed' => false],
            ['name'    => 'Project Rig - ' . now()->format('Y-m-d')]
        );

        $quantity = $request->integer('quantity', 1);

        $rig->components()->syncWithoutDetaching([
            $request->component_id => ['quantity' => $quantity],
        ]);

        $this->recalculateTotals($rig);

        return back()->with('success', 'Hardware berhasil ditambahkan ke keranjang!');
    }

    /**
     * Hapus komponen dari keranjang rakitan.
     */
    public function removeComponent(Request $request): RedirectResponse
    {
        $request->validate([
            'component_id' => 'required|exists:components,id',
            'rig_id'       => 'required|exists:rigs,id',
        ]);

        $rig = Rig::where('id', $request->rig_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $rig->components()->detach($request->component_id);

        $this->recalculateTotals($rig);

        return back()->with('success', 'Hardware berhasil dihapus dari keranjang.');
    }

    /**
     * Hitung ulang total harga dan daya rakitan.
     */
    private function recalculateTotals(Rig $rig): void
    {
        $rig->load('components');

        $rig->total_price   = $rig->components->sum(fn ($c) => $c->price * ($c->pivot->quantity ?? 1));
        $rig->total_wattage = $rig->components->sum(fn ($c) => $c->wattage * ($c->pivot->quantity ?? 1));

        $rig->save();
    }
}