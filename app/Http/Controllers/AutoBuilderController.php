<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AutoBuilderController extends Controller
{
    /**
     * Proporsi alokasi budget awal per kategori (total = 100%).
     */
    private const BUDGET_RATIOS = [
        'cpu'         => 0.25,  // 25%
        'gpu'         => 0.35,  // 35%
        'motherboard' => 0.15,  // 15%
        'ram'         => 0.10,  // 10%
        'storage'     => 0.08,  // 8%
        'psu'         => 0.07,  // 7%
    ];

    /**
     * Tampilkan halaman Auto Builder dengan rekomendasi komponen.
     */
    public function index(Request $request): View
    {
        $budget         = (int) $request->get('budget', 0);
        $recommendation = [];

        if ($budget > 0) {
            // Tahap 1: Alokasi awal berdasarkan rasio
            $recommendation = $this->buildInitialRecommendation($budget);

            // Tahap 2: Hitung sisa budget dan coba upgrade komponen
            $totalSpent = collect($recommendation)->filter()->sum('price');
            $remaining  = $budget - $totalSpent;

            if ($remaining > 0) {
                $recommendation = $this->redistributeRemaining($recommendation, $remaining);
            }
        }

        return view('autobuilder.index', compact('recommendation', 'budget'));
    }

    /**
     * Tahap 1: Pilih komponen terbaik dalam batas alokasi masing-masing kategori.
     */
    private function buildInitialRecommendation(int $budget): array
    {
        $recommendation = [];

        foreach (self::BUDGET_RATIOS as $category => $ratio) {
            $limit = (int) ($budget * $ratio);

            $recommendation[$category] = Component::where('category', $category)
                ->where('price', '<=', $limit)
                ->orderByDesc('price')
                ->first();
        }

        return $recommendation;
    }

    /**
     * Tahap 2: Distribusikan sisa budget untuk upgrade komponen yang paling "murah".
     * Prioritas upgrade: kategori dengan selisih harga terbesar dari batas alokasinya.
     */
    private function redistributeRemaining(array $recommendation, float $remaining): array
    {
        // Urutkan kategori berdasarkan prioritas upgrade (GPU dulu, lalu CPU, dll.)
        $upgradePriority = array_keys(self::BUDGET_RATIOS);

        $maxPasses = 3; // Maksimal 3 putaran redistribusi

        for ($pass = 0; $pass < $maxPasses && $remaining > 1000; $pass++) {
            $upgraded = false;

            foreach ($upgradePriority as $category) {
                $current = $recommendation[$category] ?? null;

                // Tentukan batas harga upgrade: harga saat ini + sisa budget
                $priceFloor = $current ? $current->price + 1 : 0;
                $priceCeil  = $current ? $current->price + $remaining : $remaining;

                $better = Component::where('category', $category)
                    ->where('price', '>=', $priceFloor)
                    ->where('price', '<=', $priceCeil)
                    ->orderByDesc('price')
                    ->first();

                if ($better && $better->id !== ($current?->id)) {
                    $spent     = $better->price - ($current?->price ?? 0);
                    $remaining -= $spent;
                    $recommendation[$category] = $better;
                    $upgraded  = true;
                }

                if ($remaining <= 1000) break;
            }

            // Jika tidak ada upgrade di seluruh putaran ini, hentikan
            if (!$upgraded) break;
        }

        return $recommendation;
    }
}