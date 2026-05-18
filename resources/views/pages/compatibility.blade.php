@extends('layouts.app')

@section('title', 'AI Analysis - RigCheck')

@section('content')
<div class="px-8 py-8 w-full max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="material-symbols-outlined text-[28px] text-ink">psychology</span>
                <h1 class="text-[32px] font-medium text-ink tracking-tight leading-none">Hardware Guru AI</h1>
            </div>
            <p class="text-[15px] text-ink-mute">Laporan analisis arsitektur, kompatibilitas, dan bottleneck pada <span class="text-ink font-medium">{{ $rig->name }}</span>.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="bg-canvas border border-hairline-strong text-ink px-[16px] py-[8px] rounded-[6px] font-medium text-[14px] hover:bg-hairline-cool transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Garasi
            </a>
        </div>
    </div>

    <!-- Status Banner -->
    @php
        $status = $analysisData['status'] ?? 'success';
        
        $bannerBg = 'bg-primary-soft/10';
        $bannerBorder = 'border-primary/20';
        $iconBg = 'bg-primary';
        $iconText = 'text-on-primary';
        $icon = 'check_circle';
        
        if ($status === 'warning') {
            $bannerBg = 'bg-amber-500/10';
            $bannerBorder = 'border-amber-500/20';
            $iconBg = 'bg-amber-500';
            $iconText = 'text-white';
            $icon = 'warning';
        } elseif ($status === 'danger') {
            $bannerBg = 'bg-red-500/10';
            $bannerBorder = 'border-red-500/20';
            $iconBg = 'bg-red-500';
            $iconText = 'text-white';
            $icon = 'error';
        }
    @endphp

    <div class="mb-8 p-6 rounded-[12px] border {{ $bannerBorder }} {{ $bannerBg }} flex items-start gap-5">
        <div class="w-12 h-12 rounded-[8px] shrink-0 flex items-center justify-center {{ $iconBg }} {{ $iconText }}">
            <span class="material-symbols-outlined text-[24px]">{{ $icon }}</span>
        </div>
        <div>
            <h3 class="text-[18px] font-medium text-ink uppercase tracking-wider mb-1">
                Sistem: {{ strtoupper($status) }}
            </h3>
            <p class="text-[14px] text-ink-mute leading-relaxed">
                @if($status == 'success') 
                    AI menentukan bahwa konfigurasi hardware Anda sangat seimbang dan efisien. Tidak ada masalah besar yang terdeteksi.
                @elseif($status == 'warning') 
                    Sedikit inefisiensi terdeteksi. Sistem akan berjalan, tetapi pertimbangkan komponen alternatif untuk performa optimal.
                @else 
                    Masalah kritis ditemukan! Harap selesaikan konflik kompatibilitas sebelum membeli untuk menghindari kegagalan sistem atau kerusakan fisik. 
                @endif
            </p>
        </div>
    </div>

    <!-- 3-Column Metrics Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Bottleneck -->
        <div class="bg-canvas rounded-[12px] border border-hairline p-6 flex flex-col justify-between shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
            <div>
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4">Potensi Bottleneck</p>
                <div class="py-2 text-center mb-4">
                    <p class="text-[48px] font-medium text-ink tracking-tight leading-none mb-2">
                        {{ $analysisData['bottleneck']['percentage'] ?? '0%' }}
                    </p>
                    <p class="text-[12px] text-ink-mute uppercase tracking-widest">
                        Penyebab: <span class="text-ink font-medium">{{ $analysisData['bottleneck']['component'] ?? 'Aman' }}</span>
                    </p>
                </div>
            </div>
            <div class="bg-canvas-soft border border-hairline rounded-[8px] p-4 text-[13px] text-ink-mute leading-relaxed">
                {{ $analysisData['bottleneck']['explanation'] ?? 'Tidak ada bottleneck performa yang signifikan terdeteksi di antara komponen.' }}
            </div>
        </div>

        <!-- Socket & Slot Checks -->
        <div class="bg-canvas rounded-[12px] border border-hairline p-6 flex flex-col justify-between shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
            <div>
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4">Validasi Arsitektur</p>
                
                @php $isCompatible = $analysisData['compatibility']['is_compatible'] ?? true; @endphp
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-[20px] {{ $isCompatible ? 'text-primary' : 'text-red-500' }}">
                        {{ $isCompatible ? 'verified' : 'cancel' }}
                    </span>
                    <span class="text-[15px] font-medium text-ink">
                        {{ $isCompatible ? 'Semua Arsitektur Cocok' : 'Konflik Arsitektur Terdeteksi' }}
                    </span>
                </div>
            </div>

            <div class="space-y-3 custom-scrollbar overflow-y-auto max-h-[160px] pr-2">
                @if(empty($analysisData['compatibility']['issues']))
                    <div class="bg-canvas-soft border border-hairline rounded-[8px] p-4 text-[13px] text-ink-mute italic leading-relaxed">
                        Soket CPU, chipset motherboard, dan generasi RAM tersinkronisasi dengan sempurna.
                    </div>
                @else
                    @foreach($analysisData['compatibility']['issues'] as $issue)
                        <div class="p-3 bg-red-50 border border-red-200 rounded-[8px] text-[13px] text-red-700 font-mono leading-relaxed flex gap-2 items-start">
                            <span class="material-symbols-outlined text-[16px] text-red-500 mt-0.5 shrink-0">error</span>
                            <span>{{ $issue }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Power Supply -->
        @php
            $calcWattage = $rig->components->sum(function($comp) { return $comp->wattage * ($comp->pivot->quantity ?? 1); });
        @endphp
        <div class="bg-canvas rounded-[12px] border border-hairline p-6 flex flex-col justify-between shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
            <div>
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4">Kalkulasi Daya</p>
                <div class="flex justify-between items-center bg-canvas-night border border-hairline p-5 rounded-[8px] mb-4">
                    <div>
                        <p class="text-[10px] text-on-dark/70 uppercase font-medium tracking-widest mb-1">Total Tarikan</p>
                        <p class="text-[24px] font-medium text-on-dark leading-none">{{ $calcWattage }} <span class="text-[14px] text-on-dark/70">W</span></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-on-dark">
                        <span class="material-symbols-outlined text-[20px] {{ ($analysisData['power']['is_safe'] ?? true) ? '' : 'text-amber-400' }}">bolt</span>
                    </div>
                </div>
            </div>
            <div class="bg-canvas-soft border border-hairline rounded-[8px] p-4 text-[13px] text-ink-mute leading-relaxed">
                {{ $analysisData['power']['message'] ?? 'Konsumsi daya berada dalam batas aman.' }}
            </div>
        </div>

    </div>

    <!-- Recommendations -->
    <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
        <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-[16px]">tips_and_updates</span> 
            Saran & Alternatif AI
        </p>
        <div class="text-[14px] text-ink leading-relaxed space-y-4 bg-canvas-soft p-5 rounded-[8px] border border-hairline">
            {!! nl2br(e($analysisData['recommendation'] ?? 'Tidak ada rekomendasi tambahan untuk rakitan ini.')) !!}
        </div>
    </div>
</div>
@endsection