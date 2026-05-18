@extends('layouts.app')

@section('title', 'Auto Builder')

@section('content')
@php
    $categoryIcons = [
        'cpu'         => 'memory',
        'gpu'         => 'developer_board',
        'motherboard' => 'dns',
        'ram'         => 'memory_alt',
        'storage'     => 'hard_drive',
        'psu'         => 'power',
    ];

    $totalSpent = collect($recommendation)->filter()->sum('price');
    $efficiency = $budget > 0 ? round(($totalSpent / $budget) * 100, 1) : 0;
@endphp

<div class="px-8 py-12 w-full max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-10 text-center">
        <h1 class="text-[48px] font-medium text-ink tracking-[-1.44px] mb-4">Auto Builder</h1>
        <p class="text-[17px] text-ink-mute leading-[1.55] max-w-2xl mx-auto">
            Masukkan anggaran Anda — algoritma kami akan merekomendasikan keseimbangan komponen terbaik untuk performa maksimum.
        </p>
    </div>

    {{-- Budget form --}}
    <div class="bg-canvas border border-hairline rounded-[12px] p-8 mb-10 shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
        <form action="{{ route('autobuilder.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="budget" class="block text-[14px] font-medium text-ink mb-2">Target Anggaran (Rp)</label>
                <input type="number" id="budget" name="budget"
                       value="{{ $budget > 0 ? $budget : '' }}"
                       placeholder="Contoh: 10000000"
                       min="500000"
                       class="w-full bg-canvas border border-hairline rounded-[8px] px-[14px] py-[10px] text-[16px] text-ink focus:outline-none focus:border-primary transition-colors"
                       required>
            </div>
            <button type="submit"
                    class="bg-primary text-on-primary px-[24px] py-[10px] rounded-[8px] font-medium text-[15px]
                           hover:bg-primary-deep transition-colors w-full md:w-auto flex items-center justify-center gap-2
                           shadow-[0_2px_10px_rgba(62,207,142,0.35)]">
                <span class="material-symbols-outlined text-[20px]">magic_button</span> Buat Rakitan
            </button>
        </form>
    </div>

    @if($budget > 0)

        {{-- Efficiency bar + title --}}
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[22px] font-medium text-ink tracking-tight">Rekomendasi Rakitan</h3>
            <div class="flex items-center gap-2 text-[13px]">
                <span class="text-ink-mute">Efisiensi budget:</span>
                <span class="font-medium {{ $efficiency >= 90 ? 'text-primary' : ($efficiency >= 70 ? 'text-amber-500' : 'text-red-500') }}">
                    {{ $efficiency }}%
                </span>
            </div>
        </div>

        {{-- Progress bar budget --}}
        <div class="h-1.5 bg-hairline-cool rounded-full mb-6 overflow-hidden">
            <div class="h-full bg-primary rounded-full transition-all duration-700"
                 style="width: {{ min($efficiency, 100) }}%"></div>
        </div>

        <div class="bg-canvas border border-hairline rounded-[12px] overflow-hidden shadow-[0_1px_4px_rgba(0,0,0,0.05)]">

            @php $hasAny = collect($recommendation)->filter()->count() > 0; @endphp

            @if($hasAny)
                @foreach($recommendation as $type => $item)
                    @if($item)
                        @php
                            $icon       = $categoryIcons[$type] ?? 'developer_board';
                            $percentage = round(($item->price / $budget) * 100, 1);
                        @endphp
                        <div class="group px-6 py-5 border-b border-hairline last:border-b-0 flex items-center justify-between hover:bg-canvas-soft transition-colors">
                            {{-- Icon + info --}}
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-[10px] bg-canvas-soft border border-hairline
                                            flex items-center justify-center text-ink-mute
                                            group-hover:bg-canvas-night group-hover:text-primary group-hover:border-canvas-night
                                            transition-all duration-200 shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">{{ $icon }}</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-ink-mute uppercase tracking-widest font-medium mb-1">{{ strtoupper($type) }}</p>
                                    <h4 class="text-[16px] font-medium text-ink leading-snug">{{ $item->name }}</h4>
                                    @if($item->spesifikasi && count($item->spesifikasi) > 0)
                                        <p class="text-[12px] text-ink-mute font-mono mt-0.5">
                                            @foreach($item->spesifikasi as $key => $val)
                                                @if(!is_array($val))
                                                    <span class="mr-3">{{ ucfirst($key) }}: {{ $val }}</span>
                                                @endif
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- Harga + proporsi --}}
                            <div class="text-right shrink-0 ml-4">
                                <p class="text-[17px] font-medium text-ink">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <p class="text-[12px] text-ink-mute">{{ $percentage }}% dari anggaran</p>
                            </div>
                        </div>
                    @else
                        {{-- Kategori tidak ditemukan --}}
                        <div class="px-6 py-4 border-b border-hairline last:border-b-0 flex items-center justify-between opacity-50">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-[10px] bg-canvas-soft border border-hairline border-dashed flex items-center justify-center text-ink-faint shrink-0">
                                    <span class="material-symbols-outlined text-[20px]">{{ $categoryIcons[$type] ?? 'help' }}</span>
                                </div>
                                <div>
                                    <p class="text-[11px] text-ink-mute uppercase tracking-widest font-medium mb-1">{{ strtoupper($type) }}</p>
                                    <p class="text-[14px] text-ink-mute italic">Tidak ada komponen yang sesuai anggaran</p>
                                </div>
                            </div>
                            <p class="text-[13px] text-ink-faint">—</p>
                        </div>
                    @endif
                @endforeach

                {{-- Footer total --}}
                <div class="bg-canvas-night px-6 py-5 flex items-center justify-between">
                    <div>
                        <p class="text-[12px] text-on-dark/60 uppercase tracking-widest mb-1">Total Estimasi</p>
                        <p class="text-[24px] font-medium text-on-dark tracking-tight">
                            Rp {{ number_format($totalSpent, 0, ',', '.') }}
                            <span class="text-[14px] text-on-dark/50 font-normal ml-1">dari Rp {{ number_format($budget, 0, ',', '.') }}</span>
                        </p>
                    </div>
                    <a href="{{ route('builder.index') }}"
                       class="bg-canvas text-ink px-[16px] py-[9px] rounded-[8px] font-medium text-[13px]
                              hover:bg-hairline-cool transition-colors border border-hairline">
                        Sesuaikan di Katalog
                    </a>
                </div>

            @else
                <div class="py-16 text-center">
                    <div class="w-16 h-16 bg-canvas-soft rounded-full border border-hairline flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-[28px] text-ink-faint">search_off</span>
                    </div>
                    <p class="text-[17px] font-medium text-ink mb-2">Tidak ada rekomendasi ditemukan</p>
                    <p class="text-[14px] text-ink-mute">Anggaran terlalu kecil. Coba masukkan angka yang lebih besar.</p>
                </div>
            @endif

        </div>
    @endif

</div>
@endsection
