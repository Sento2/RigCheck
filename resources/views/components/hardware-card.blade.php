@props([
    'item',
    'icon' => 'developer_board',
])

{{--
    Hardware Card Component
    ========================
    Props:
    - $item  : App\Models\Component — instance komponen yang akan ditampilkan
    - $icon  : string — nama Material Symbol icon sesuai kategori (default: developer_board)
--}}
<div class="card-lift group bg-canvas border border-hairline rounded-[12px] px-6 py-5 flex items-center justify-between">

    {{-- ── Kiri: Icon + Info ── --}}
    <div class="flex items-center gap-5 min-w-0">

        {{-- Icon kontekstual per kategori --}}
        <div class="w-14 h-14 shrink-0 bg-canvas-soft rounded-[10px] border border-hairline
                    flex items-center justify-center text-ink-mute
                    group-hover:bg-canvas-night group-hover:text-primary group-hover:border-canvas-night
                    transition-all duration-200">
            <span class="material-symbols-outlined text-[22px]">{{ $icon }}</span>
        </div>

        {{-- Metadata --}}
        <div class="min-w-0">
            {{-- Badges: kategori + daya --}}
            <div class="flex items-center gap-2 mb-1.5">
                <span class="bg-canvas-night text-on-dark text-[11px] px-2 py-0.5 rounded-[4px] uppercase font-medium tracking-wide shrink-0">
                    {{ $item->category }}
                </span>
                <span class="text-ink-mute text-[12px] font-mono shrink-0">{{ $item->wattage }}W</span>
            </div>

            {{-- Nama komponen --}}
            <h4 class="text-[16px] font-medium text-ink leading-snug mb-1.5 truncate">
                {{ $item->name }}
            </h4>

            {{-- Spesifikasi teknis (key: val) --}}
            @if($item->spesifikasi && count($item->spesifikasi) > 0)
                <div class="flex flex-wrap gap-x-4 font-mono text-[12px] text-ink-mute-2">
                    @foreach($item->spesifikasi as $key => $val)
                        @if(!is_array($val))
                            <span>
                                <span class="text-ink-faint">{{ ucfirst($key) }}:</span>
                                <span class="text-ink-mute"> {{ $val }}</span>
                            </span>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- ── Kanan: Harga + Tombol Tambah ── --}}
    <div class="flex items-center gap-6 shrink-0 ml-6">

        {{-- Harga --}}
        <div class="text-right hidden sm:block">
            <p class="text-[11px] text-ink-mute uppercase tracking-widest mb-0.5">Harga</p>
            <p class="text-[20px] font-medium text-ink tracking-tight leading-none">
                <span class="text-[13px] text-ink-mute font-normal">Rp</span>{{ number_format($item->price, 0, ',', '.') }}
            </p>
        </div>

        {{-- Tombol Tambah ke Keranjang --}}
        <form action="{{ route('rigs.add_component') }}" method="POST" class="m-0 p-0">
            @csrf
            <input type="hidden" name="component_id" value="{{ $item->id }}">
            <button type="submit"
                    title="Tambah ke rakitan"
                    class="bg-primary/10 border border-primary/20 text-primary
                           hover:bg-primary hover:text-on-primary
                           px-[14px] py-[8px] rounded-[8px]
                           transition-all duration-150
                           flex items-center gap-1.5 text-[13px] font-medium
                           active:scale-95">
                <span class="material-symbols-outlined text-[16px]">add</span>
                <span class="hidden sm:inline">Tambah</span>
            </button>
        </form>
    </div>

</div>