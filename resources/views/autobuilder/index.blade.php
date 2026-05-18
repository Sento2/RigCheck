@extends('layouts.app')

@section('title', 'Auto Builder')

@section('content')
<div class="px-8 py-12 w-full max-w-4xl mx-auto">
    <div class="mb-12 text-center">
        <h1 class="text-[48px] font-medium text-ink tracking-[-1.44px] mb-4">Auto Builder</h1>
        <p class="text-[18px] text-ink-mute leading-[1.55] max-w-2xl mx-auto">
            Masukkan anggaran Anda dan algoritma AI kami akan merekomendasikan keseimbangan komponen terbaik untuk performa maksimum.
        </p>
    </div>

    <div class="bg-canvas border border-hairline rounded-[12px] p-8 mb-12 shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
        <form action="{{ route('autobuilder.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label for="budget" class="block text-[14px] font-medium text-ink mb-2">Target Anggaran (Rp)</label>
                <input type="number" id="budget" name="budget" value="{{ $budget > 0 ? $budget : '' }}" placeholder="e.g. 15000000" class="w-full bg-canvas border border-hairline rounded-[6px] px-[12px] py-[8px] text-[16px] text-ink focus:outline-none focus:border-hairline-strong transition-colors" required>
            </div>
            <button type="submit" class="bg-primary text-on-primary px-[24px] py-[10px] rounded-[6px] font-medium text-[16px] hover:bg-primary-deep transition-colors w-full md:w-auto flex items-center justify-center gap-2 h-[42px]">
                <span class="material-symbols-outlined text-[20px]">magic_button</span> Buat Rakitan
            </button>
        </form>
    </div>

    @if($budget > 0)
        <h3 class="text-[28px] font-medium text-ink tracking-[-0.42px] mb-6">Rekomendasi Rakitan</h3>
        
        <div class="bg-canvas border border-hairline rounded-[12px] overflow-hidden">
            @forelse($recommendation as $type => $item)
                @if($item)
                    <div class="p-6 border-b border-hairline last:border-b-0 flex items-center justify-between hover:bg-canvas-soft transition-colors">
                        <div class="flex items-center gap-6">
                            <div class="w-12 h-12 rounded-[6px] bg-canvas-night flex items-center justify-center text-on-dark shrink-0">
                                <span class="material-symbols-outlined">
                                    {{ $type === 'cpu' ? 'memory' : ($type === 'gpu' ? 'developer_board' : 'dns') }}
                                </span>
                            </div>
                            <div>
                                <p class="text-[12px] text-ink-mute uppercase tracking-widest font-medium mb-1">{{ strtoupper($type) }}</p>
                                <h4 class="text-[18px] font-medium text-ink">{{ $item->name }}</h4>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[18px] font-medium text-ink">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-[13px] text-ink-mute">{{ number_format(($item->price / $budget) * 100, 1) }}% dari anggaran</p>
                        </div>
                    </div>
                @endif
            @empty
                <div class="p-8 text-center text-ink-mute">
                    Tidak ada rekomendasi yang ditemukan untuk anggaran ini. Coba tambah jumlahnya.
                </div>
            @endforelse
            
            @if(count($recommendation) > 0)
                <div class="bg-canvas-night p-6 flex items-center justify-between">
                    <div>
                        <p class="text-[14px] text-on-dark/70">Total Estimasi</p>
                        <p class="text-[22px] font-medium text-on-dark">
                            Rp {{ number_format(collect($recommendation)->filter()->sum('price'), 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('builder.index') }}" class="bg-canvas text-ink px-[16px] py-[8px] rounded-[6px] font-medium text-[14px] hover:bg-hairline-cool transition-colors border border-transparent">
                        Sesuaikan di Katalog
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
