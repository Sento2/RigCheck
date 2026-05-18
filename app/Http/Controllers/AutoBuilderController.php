<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AutoBuilderController extends Controller
{
    /**
     * Proporsi alokasi budget per kategori komponen.
     */
    private const BUDGET_RATIOS = [
        'cpu'         => 0.30,
        'gpu'         => 0.40,
        'motherboard' => 0.15,
    ];

    /**
     * Tampilkan halaman Auto Builder dengan rekomendasi komponen.
     */
    public function index(Request $request): View
    {
        $budget         = (int) $request->get('budget', 0);
        $recommendation = [];

        if ($budget > 0) {
            foreach (self::BUDGET_RATIOS as $category => $ratio) {
                $limit = $budget * $ratio;

                $recommendation[$category] = Component::where('category', $category)
                    ->where('price', '<=', $limit)
                    ->orderByDesc('price')
                    ->first();
            }
        }

        return view('autobuilder.index', compact('recommendation', 'budget'));
    }
}