@extends('layouts.app')

@section('title', 'My Garage')

@section('content')
<div class="px-8 py-8 w-full max-w-6xl mx-auto">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-[36px] font-medium text-ink tracking-[-0.72px] mb-2">Garasi Saya</h1>
            <p class="text-[16px] text-ink-mute leading-[1.5]">Kelola rakitan PC dan keranjang Anda.</p>
        </div>
        <div>
            <a href="{{ route('builder.index') }}" class="bg-primary text-on-primary px-[16px] py-[8px] rounded-[6px] font-medium hover:bg-primary-deep transition-colors flex items-center gap-2 text-[14px]">
                <span class="material-symbols-outlined text-[18px]">add</span> Rakit PC Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-primary-soft/10 border border-primary rounded-[8px] flex items-center gap-3 text-ink">
            <span class="material-symbols-outlined text-primary">check_circle</span>
            <p class="text-[14px] font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @forelse($rigs as $rig)
        <div class="mb-12 bg-canvas border border-hairline rounded-[12px] overflow-hidden shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
            <!-- Rig Header -->
            @php
                $calcWattage = $rig->components->sum(function($comp) { return $comp->wattage * ($comp->pivot->quantity ?? 1); });
                $calcPrice = $rig->components->sum(function($comp) { return $comp->price * ($comp->pivot->quantity ?? 1); });
            @endphp
            <div class="bg-canvas-soft border-b border-hairline p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h3 class="text-[20px] font-medium text-ink tracking-tight">{{ $rig->name }}</h3>
                        @if(!$rig->is_completed)
                            <span class="bg-canvas-night text-on-dark text-[10px] px-2 py-0.5 rounded-[4px] uppercase font-medium tracking-wider">Draf / Keranjang</span>
                        @endif
                    </div>
                    <p class="text-[13px] text-ink-mute font-mono">Dibuat: {{ $rig->created_at->format('M d, Y') }}</p>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-canvas border border-hairline rounded-[8px] px-4 py-2 flex flex-col justify-center min-w-[120px]">
                        <p class="text-[10px] text-ink-mute uppercase tracking-widest font-medium mb-0.5">Daya</p>
                        <p class="text-[18px] font-medium text-ink leading-tight">{{ $calcWattage }} <span class="text-[12px] text-ink-mute">W</span></p>
                    </div>
                    <div class="bg-canvas-night border border-hairline rounded-[8px] px-4 py-2 flex flex-col justify-center min-w-[160px]">
                        <p class="text-[10px] text-on-dark/70 uppercase tracking-widest font-medium mb-0.5">Est. Biaya</p>
                        <p class="text-[18px] font-medium text-on-dark leading-tight"><span class="text-[12px] text-on-dark/70">Rp</span> {{ number_format($calcPrice, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Components List -->
            @if($rig->components->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-hairline bg-canvas">
                                <th class="py-3 px-6 text-[12px] font-medium text-ink-mute uppercase tracking-widest">Komponen</th>
                                <th class="py-3 px-6 text-[12px] font-medium text-ink-mute uppercase tracking-widest">Kategori</th>
                                <th class="py-3 px-6 text-[12px] font-medium text-ink-mute uppercase tracking-widest text-right">Harga</th>
                                <th class="py-3 px-6 text-[12px] font-medium text-ink-mute uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-hairline">
                            @foreach($rig->components as $component)
                                <tr class="bg-canvas hover:bg-canvas-soft transition-colors group">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-canvas-soft rounded-[6px] border border-hairline flex items-center justify-center text-ink-mute shrink-0">
                                                <span class="material-symbols-outlined text-[20px]">developer_board</span>
                                            </div>
                                            <div>
                                                <p class="text-[14px] font-medium text-ink">{{ $component->name }}</p>
                                                <p class="text-[12px] text-ink-mute font-mono mt-0.5">{{ $component->wattage }}W</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="bg-canvas-night text-on-dark text-[11px] px-2 py-0.5 rounded-[4px] uppercase font-medium">{{ $component->category }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="text-[14px] font-medium text-ink">Rp {{ number_format($component->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('rigs.remove_component') }}" method="POST" class="inline-block m-0 p-0">
                                            @csrf
                                            <input type="hidden" name="rig_id" value="{{ $rig->id }}">
                                            <input type="hidden" name="component_id" value="{{ $component->id }}">
                                            <button type="submit" class="text-ink-mute hover:text-red-500 hover:bg-red-50 p-2 rounded-[6px] transition-colors" title="Remove Component">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <span class="material-symbols-outlined text-[48px] text-hairline-strong mb-4">shopping_cart</span>
                    <p class="text-[16px] font-medium text-ink mb-1">Keranjang Anda kosong</p>
                    <p class="text-[14px] text-ink-mute mb-6">Telusuri katalog untuk menambahkan komponen hardware.</p>
                    <a href="{{ route('builder.index') }}" class="text-primary font-medium hover:underline text-[14px]">Ke Katalog</a>
                </div>
            @endif
        </div>
    @empty
        <div class="py-20 text-center bg-canvas border border-hairline rounded-[12px]">
            <span class="material-symbols-outlined text-[48px] text-hairline-strong mb-4">garage</span>
            <p class="text-[18px] font-medium text-ink mb-2">Garasi Anda kosong</p>
            <p class="text-[14px] text-ink-mute mb-6">Anda belum memulai merakit PC apa pun.</p>
            <a href="{{ route('builder.index') }}" class="bg-primary text-on-primary px-[16px] py-[8px] rounded-[6px] font-medium text-[14px] hover:bg-primary-deep transition-colors">
                Mulai Merakit
            </a>
        </div>
    @endforelse
</div>
@endsection