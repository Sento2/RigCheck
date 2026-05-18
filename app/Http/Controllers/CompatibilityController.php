<?php

namespace App\Http\Controllers;

use App\Models\Rig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Ai\Agents\HardwareGuruAgent; 
use Laravel\Ai\Enums\Lab;

class CompatibilityController extends Controller
{

    public function index($id)
    {
        $rig = Rig::with('components')->findOrFail($id);


        if ($rig->components->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong, tambahkan komponen dulu bro!');
        }


        $systemPrompt = HardwareGuruAgent::getSystemPrompt();
        $userPrompt = HardwareGuruAgent::formatRigData($rig->components);


        $apiKey = env('GEMINI_API_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        ['text' => $systemPrompt . "\n\n" . $userPrompt]
                    ]
                ]
            ],
            // Memaksa Gemini agar fokus merespons dengan struktur JSON
            'generationConfig' => [
                'responseMimeType' => 'application/json',
            ]
        ]);

        // 4. Tangkap dan olah hasilnya
        if ($response->successful()) {
            $aiResult = $response->json('candidates.0.content.parts.0.text');
            $analysisData = json_decode(trim($aiResult), true);
            
            return view('pages.compatibility', compact('rig', 'analysisData'));
        }

        // Jika API gagal merespons
        return back()->with('error', 'Waduh, AI-nya lagi sibuk atau API Key bermasalah. Coba lagi nanti!');
    }
}