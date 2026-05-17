@extends('layouts.app')

@section('title', 'Workspace Builder')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-surface-container rounded-xl p-6 border border-outline-variant shadow-sm flex items-center gap-6">
            <div class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <div>
                <p class="text-on-surface-variant font-label-tech text-xs uppercase">Estimasi Harga (Keranjang)</p>
                <p class="font-headline-lg text-2xl font-bold text-on-surface">Rp 0</p>
            </div>
        </div>
        <div class="bg-surface-container rounded-xl p-6 border border-outline-variant shadow-sm flex items-center gap-6">
            <div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary-container">
                <span class="material-symbols-outlined">bolt</span>
            </div>
            <div>
                <p class="text-on-surface-variant font-label-tech text-xs uppercase">Estimasi Daya</p>
                <p class="font-headline-lg text-2xl font-bold text-on-surface">0 W</p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="font-headline-lg-mobile text-2xl font-bold text-on-surface mb-6">Katalog Hardware</h3>

        @foreach($components as $category => $items)
            <h4 class="font-label-tech text-primary uppercase mt-8 mb-2 border-b border-outline-variant pb-2 tracking-widest text-xs">
                ⚡ Kategori: {{ str_replace('_', ' ', $category) }}
            </h4>
            
            @foreach($items as $item)
                <div class="bg-surface-variant border border-outline-variant rounded-xl p-4 flex items-center justify-between group hover:border-primary/50 transition-colors">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-surface-container-lowest rounded-lg border border-outline-variant flex items-center justify-center text-primary shadow-inner">
                            <span class="material-symbols-outlined text-3xl">developer_board</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="bg-primary/10 text-primary font-label-tech text-[10px] px-2 py-0.5 rounded uppercase font-bold">{{ $item->category }}</span>
                                <span class="bg-surface-container-highest text-on-surface-variant font-label-tech text-[10px] px-2 py-0.5 rounded uppercase">{{ $item->wattage }}W Daya</span>
                            </div>
                            <h4 class="font-headline-lg-mobile text-lg font-bold text-on-surface mt-1 group-hover:text-primary transition-colors">{{ $item->name }}</h4>
                            
                            <p class="text-xs text-on-surface-variant mt-1 font-mono bg-background/40 py-1 px-2 rounded inline-block">
                                @foreach($item->spesifikasi as $key => $val)
                                    @if(!is_array($val)) 
                                        <span class="text-primary/70">{{ ucfirst($key) }}:</span> <span class="text-on-surface mr-2">{{ $val }}</span>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <span class="font-headline-lg-mobile text-xl font-bold text-on-surface">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        <button class="text-primary hover:bg-primary hover:text-on-primary p-2 rounded-lg transition-all border border-primary/20 active:scale-95">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
@endsection