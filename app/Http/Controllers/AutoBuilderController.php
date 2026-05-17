<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;

class AutoBuilderController extends Controller
{
    public function index(Request $request)
    {
        $budget = $request->get('budget', 0);
        $recommendation = [];

        if ($budget > 0) {
            // Algoritma sederhana pembagian budget rakitan komputer ideal
            // CPU 30%, GPU 40%, Motherboard 15%, RAM & Sisa 15%
            $cpuBudget = $budget * 0.30;
            $gpuBudget = $budget * 0.40;
            $moboBudget = $budget * 0.15;

            $recommendation['cpu'] = Component::where('category', 'cpu')->where('price', '<=', $cpuBudget)->orderBy('price', 'desc')->first();
            $recommendation['gpu'] = Component::where('category', 'gpu')->where('price', '<=', $gpuBudget)->orderBy('price', 'desc')->first();
            $recommendation['motherboard'] = Component::where('category', 'motherboard')->where('price', '<=', $moboBudget)->orderBy('price', 'desc')->first();
        }

        return view('autobuilder.index', compact('recommendation', 'budget'));
    }
}