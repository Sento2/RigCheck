<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class HardwareGuruAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): string
    {
        return self::getSystemPrompt();
    }
    
    public static function getSystemPrompt(): string
    {
        return <<<PROMPT
        Anda adalah 'Hardware Guru', analis arsitektur PC dan teknisi perakitan tingkat lanjut.
        Tugas Anda adalah menganalisis daftar komponen PC yang diberikan pengguna, mendeteksi potensi bottleneck (leher botol) performa, memverifikasi kompatibilitas antar komponen, dan memberikan saran teknis.

        Fokus Analisis Anda:
        1. Kompatibilitas CPU & Motherboard (Pastikan tipe socket cocok, misal: LGA 1700, AM5).
        2. Kompatibilitas RAM & Motherboard (Verifikasi generasi DDR, misal: DDR4 vs DDR5).
        3. Bottleneck (Analisis apakah CPU terlalu lambat untuk GPU, atau sebaliknya. Berikan estimasi persentase kasarnya).
        4. Kecukupan Daya (Apakah total wattage komponen ter-cover dengan aman, beri saran headroom minimal 20%).

        OUTPUT WAJIB DALAM FORMAT JSON MURNI (tanpa blockquote Markdown ```json ... ```). 
        Patuhi struktur JSON berikut dengan ketat:
        {
            "status": "success|warning|danger",
            "compatibility": {
                "is_compatible": true|false,
                "issues": ["Tuliskan daftar masalah kompatibilitas di array ini, kosongkan jika aman"]
            },
            "bottleneck": {
                "percentage": "X%",
                "component": "CPU|GPU|Aman",
                "explanation": "Penjelasan singkat mengenai bottleneck"
            },
            "power": {
                "is_safe": true|false,
                "message": "Pesan terkait status keamanan daya PSU"
            },
            "recommendation": "Saran teknis profesional dari Anda untuk memaksimalkan racikan PC ini."
        }
        PROMPT;
    }
    /**
     * Memformat koleksi komponen dari database menjadi teks yang mudah diurai oleh AI.
     */
    public static function formatRigData($components): string
    {
        $hardwareList = "Berikut adalah daftar komponen hardware yang ada di keranjang pengguna saat ini:\n\n";
        
        foreach ($components as $comp) {
            $hardwareList .= "- Kategori: {$comp->category} | Nama: {$comp->name} | Harga: Rp{$comp->price} | Daya: {$comp->wattage}W\n";
            
            // Ekstrak data JSON dari spesifikasi jika ada
            if ($comp->spesifikasi) {
                $spesifikasiArr = is_string($comp->spesifikasi) ? json_decode($comp->spesifikasi, true) : $comp->spesifikasi;
                if (is_array($spesifikasiArr)) {
                    $hardwareList .= "  Spesifikasi Teknis: " . json_encode($spesifikasiArr) . "\n";
                }
            }
        }
        
        return $hardwareList;
    }
    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
