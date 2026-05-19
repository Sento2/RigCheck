@extends('layouts.app')

@section('title', 'AI Powered PC Builder')

@section('content')

{{-- ─── Hero Section ─── --}}
<div class="w-full flex justify-center relative overflow-hidden bg-canvas" style="min-height: calc(100vh - 80px);">

    {{-- Decorative background grid --}}
    <div class="absolute inset-0 pointer-events-none" style="
        background-image: linear-gradient(rgba(62,207,142,0.04) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(62,207,142,0.04) 1px, transparent 1px);
        background-size: 48px 48px;
    "></div>

    {{-- Radial glow center --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] pointer-events-none" style="
        background: radial-gradient(ellipse at center, rgba(62,207,142,0.10) 0%, transparent 70%);
    "></div>

    <div class="relative max-w-[1280px] w-full px-6 flex flex-col items-center text-center pt-24 md:pt-32 pb-20">

        {{-- Badge --}}
        <div class="animate-fade-up flex items-center gap-2 bg-canvas border border-hairline rounded-full px-4 py-1.5 mb-8 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-primary animate-pulse-green block"></span>
            <span class="text-[13px] font-medium text-ink-mute tracking-wide">Didukung AI · Gratis Selamanya</span>
        </div>

        {{-- Headline --}}
        <h1 class="animate-fade-up delay-100 text-[52px] md:text-[72px] font-medium text-ink leading-[1.05] tracking-[-2.5px] mb-6 max-w-4xl mx-auto">
            Rakit PC ideal Anda <br>
            <span class="text-gradient-primary">dengan arsitektur cerdas.</span>
        </h1>

        {{-- Subtext --}}
        <p class="animate-fade-up delay-200 text-[18px] text-ink-mute leading-[1.6] max-w-2xl mx-auto mb-10">
            RigCheck menganalisis batas bottleneck, kompatibilitas soket, dan batasan daya secara instan — sebelum Anda membeli sebuah komponen pun.
        </p>

        {{-- CTAs --}}
        <div class="animate-fade-up delay-300 flex flex-col sm:flex-row items-center gap-4 mb-16">
            <a href="{{ route('builder.index') }}"class="group bg-primary text-on-primary px-[28px] py-[13px] rounded-[8px] font-medium text-[16px] hover:bg-primary-deep transition-all flex items-center justify-center gap-2 min-w-[180px] shadow-[0_2px_12px_rgba(62,207,142,0.4)] hover:shadow-[0_4px_20px_rgba(62,207,142,0.5)] hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-[18px]">construction</span>
                Mulai Merakit
            </a>
            <a href="{{ route('autobuilder.index') }}"class="bg-canvas-night text-on-dark px-[28px] py-[13px] rounded-[8px] font-medium text-[16px] hover:bg-canvas-night-soft transition-all flex items-center justify-center gap-2 min-w-[180px] hover:-translate-y-0.5">
                <span class="material-symbols-outlined text-[18px]">magic_button</span>
                Auto Builder
            </a>
        </div>

        {{-- Stats Bar --}}
        <div class="animate-fade-up delay-400 flex flex-col sm:flex-row items-center gap-6 sm:gap-12 border-t border-hairline pt-8 w-full max-w-xl mx-auto">
            <div class="text-center">
                <p class="text-[28px] font-medium text-ink tracking-tight">100+</p>
                <p class="text-[13px] text-ink-mute mt-0.5">Komponen tersedia</p>
            </div>
            <div class="hidden sm:block w-px h-8 bg-hairline"></div>
            <div class="text-center">
                <p class="text-[28px] font-medium text-ink tracking-tight">Instan</p>
                <p class="text-[13px] text-ink-mute mt-0.5">Analisis AI real-time</p>
            </div>
            <div class="hidden sm:block w-px h-8 bg-hairline"></div>
            <div class="text-center">
                <p class="text-[28px] font-medium text-ink tracking-tight">0 Error</p>
                <p class="text-[13px] text-ink-mute mt-0.5">Kompatibilitas tervalidasi</p>
            </div>
        </div>

    </div>
</div>

{{-- ─── Features Section ─── --}}
<div class="w-full bg-canvas-soft py-24 border-t border-hairline">
    <div class="max-w-[1280px] mx-auto px-6">

        <div class="text-center mb-16">
            <p class="text-[12px] font-medium text-primary uppercase tracking-[0.15em] mb-3">Teknologi</p>
            <h2 class="text-[40px] font-medium text-ink tracking-[-0.8px]">Dirancang untuk presisi.</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Card 1 --}}
            <div class="card-lift bg-canvas p-8 rounded-[16px] border border-hairline group">
                <div class="w-12 h-12 rounded-[10px] bg-canvas-night text-on-dark flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                    <span class="material-symbols-outlined text-[22px]">psychology</span>
                </div>
                <h3 class="text-[22px] font-medium text-ink tracking-tight mb-3">Hardware Guru AI</h3>
                <p class="text-[15px] text-ink-mute leading-[1.6]">
                    Analisis arsitektur mendalam oleh AI untuk mendeteksi bottleneck performa antara prosesor (CPU) dan kartu grafis pilihan Anda.
                </p>
                <div class="mt-6 pt-6 border-t border-hairline flex items-center gap-2 text-[13px] font-medium text-primary">
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    Coba analisis AI
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="card-lift bg-canvas-night p-8 rounded-[16px] border border-hairline-strong group">
                <div class="w-12 h-12 rounded-[10px] bg-white/10 text-on-dark flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                    <span class="material-symbols-outlined text-[22px]">verified</span>
                </div>
                <h3 class="text-[22px] font-medium text-on-dark tracking-tight mb-3">Validasi Soket</h3>
                <p class="text-[15px] text-on-dark/60 leading-[1.6]">
                    Verifikasi otomatis pinout soket prosesor dengan motherboard dan kompatibilitas generasi RAM (DDR4/DDR5).
                </p>
                <div class="mt-6 pt-6 border-t border-white/10 flex items-center gap-2 text-[13px] font-medium text-primary">
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    Lihat kompatibilitas
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="card-lift bg-canvas p-8 rounded-[16px] border border-hairline group">
                <div class="w-12 h-12 rounded-[10px] bg-canvas-night text-on-dark flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-on-primary transition-colors">
                    <span class="material-symbols-outlined text-[22px]">bolt</span>
                </div>
                <h3 class="text-[22px] font-medium text-ink tracking-tight mb-3">Kalkulasi Daya</h3>
                <p class="text-[15px] text-ink-mute leading-[1.6]">
                    Perhitungan akumulasi watt dari setiap komponen di dalam Rig Anda, lengkap dengan batas aman untuk Power Supply.
                </p>
                <div class="mt-6 pt-6 border-t border-hairline flex items-center gap-2 text-[13px] font-medium text-primary">
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    Rakit sekarang
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ─── How It Works Section ─── --}}
<div class="w-full bg-canvas py-24 border-t border-hairline">
    <div class="max-w-[1280px] mx-auto px-6">

        <div class="text-center mb-16">
            <p class="text-[12px] font-medium text-primary uppercase tracking-[0.15em] mb-3">Cara Kerja</p>
            <h2 class="text-[40px] font-medium text-ink tracking-[-0.8px]">Tiga langkah, satu keputusan tepat.</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">

            {{-- Connector line (desktop only) --}}
            <div class="hidden md:block absolute top-8 left-1/4 right-1/4 h-px bg-hairline z-0"></div>

            <div class="relative flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 rounded-full bg-canvas border-2 border-hairline flex items-center justify-center mb-6 text-[24px] font-medium text-ink shadow-sm">1</div>
                <h4 class="text-[18px] font-medium text-ink mb-2">Pilih Komponen</h4>
                <p class="text-[15px] text-ink-mute leading-[1.6]">Telusuri katalog hardware kami dan tambahkan komponen ke keranjang rakitan Anda.</p>
            </div>

            <div class="relative flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center mb-6 text-[24px] font-medium text-on-primary shadow-[0_4px_16px_rgba(62,207,142,0.35)]">2</div>
                <h4 class="text-[18px] font-medium text-ink mb-2">Analisis AI</h4>
                <p class="text-[15px] text-ink-mute leading-[1.6]">Hardware Guru AI menganalisis kompatibilitas, bottleneck, dan kalkulasi daya secara instan.</p>
            </div>

            <div class="relative flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 rounded-full bg-canvas border-2 border-hairline flex items-center justify-center mb-6 text-[24px] font-medium text-ink shadow-sm">3</div>
                <h4 class="text-[18px] font-medium text-ink mb-2">Rakit dengan Yakin</h4>
                <p class="text-[15px] text-ink-mute leading-[1.6]">Beli dan rakit PC Anda dengan keyakinan penuh — tanpa rasa takut salah beli komponen.</p>
            </div>
        </div>

    </div>
</div>

{{-- ─── CTA Section ─── --}}
<div class="w-full bg-canvas-night py-24 border-t border-hairline-strong">
    <div class="max-w-[1280px] mx-auto px-6 text-center">
        <h2 class="text-[40px] font-medium text-on-dark tracking-[-0.8px] mb-4">Siap merakit PC impian Anda?</h2>
        <p class="text-[17px] text-on-dark/60 mb-10 max-w-xl mx-auto">Bergabung dengan RigCheck dan mulai merakit dengan panduan AI yang lebih cerdas dari siapa pun.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('register') }}"
               class="bg-primary text-on-primary px-[28px] py-[13px] rounded-[8px] font-medium text-[16px] hover:bg-primary-deep transition-all hover:-translate-y-0.5 flex items-center gap-2 shadow-[0_4px_20px_rgba(62,207,142,0.4)]">
                <span class="material-symbols-outlined text-[18px]">person_add</span>
                Daftar Gratis
            </a>
            <a href="{{ route('builder.index') }}"
               class="border border-white/20 text-on-dark px-[28px] py-[13px] rounded-[8px] font-medium text-[16px] hover:bg-white/10 transition-all hover:-translate-y-0.5 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">construction</span>
                Coba Tanpa Daftar
            </a>
        </div>
    </div>
</div>

@endsection