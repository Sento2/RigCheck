<?php

namespace App\Http\Controllers;

use App\Models\Rig;
use Illuminate\Http\Request;

class CompatibilityController extends Controller
{
    public function index($rigId)
    {
        $rig = Rig::with('components')->findOrFail($rigId);
        
        $cpu = $rig->components->where('category', 'cpu')->first();
        $motherboard = $rig->components->where('category', 'motherboard')->first();
        
        $isCompatible = true;
        $notes = "Semua komponen kompatibel, siap dirakit bro!";

        // Contoh Logika Cek Kecocokan Socket CPU dan Motherboard lewat JSON spesifikasi
        if ($cpu && $motherboard) {
            $cpuSocket = $cpu->spesifikasi['socket'] ?? null;
            $moboSocket = $motherboard->spesifikasi['socket'] ?? null;

            if ($cpuSocket && $moboSocket && $cpuSocket !== $moboSocket) {
                $isCompatible = false;
                $notes = "Waduh! CPU dengan socket {$cpuSocket} tidak muat di Motherboard dengan socket {$moboSocket}.";
            }
        }

        return view('compatibility.index', compact('rig', 'isCompatible', 'notes'));
    }
}