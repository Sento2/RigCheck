@extends('layouts.app')

@section('title', 'Workspace Builder')

@section('content')
<div class="px-8 py-8 pb-24 w-full max-w-6xl mx-auto">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-[36px] font-medium text-ink tracking-[-0.72px] mb-2">Katalog Hardware</h1>
            <p class="text-[16px] text-ink-mute leading-[1.5]">Pilih komponen untuk rakitan Anda.</p>
        </div>
        
        <!-- Rig summary pane -->
        <div class="flex gap-4">
            <div class="bg-canvas border border-hairline rounded-[12px] px-6 py-4 flex flex-col justify-center min-w-[200px]">
                <p class="text-[12px] text-ink-mute uppercase tracking-widest font-medium mb-1">Total Daya</p>
                <p class="text-[28px] font-medium text-ink leading-[1.2] tracking-[-0.42px]">
                    {{ $currentRig ? $currentRig->total_wattage : '0' }} <span class="text-[18px] text-ink-mute">W</span>
                </p>
            </div>
            <div class="bg-canvas-night border border-hairline rounded-[12px] px-6 py-4 flex flex-col justify-center min-w-[250px]">
                <p class="text-[12px] text-on-dark/70 uppercase tracking-widest font-medium mb-1">Estimasi Biaya</p>
                <p class="text-[28px] font-medium text-on-dark leading-[1.2] tracking-[-0.42px]">
                    <span class="text-[18px] text-on-dark/70">Rp</span> {{ $currentRig ? number_format($currentRig->total_price, 0, ',', '.') : '0' }}
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-primary-soft/10 border border-primary rounded-[8px] flex items-center gap-3 text-ink">
            <span class="material-symbols-outlined text-primary">check_circle</span>
            <p class="text-[14px] font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div id="component-list" class="space-y-12">

        @php
        $categoryIcons = [
            'cpu'         => 'memory',
            'gpu'         => 'developer_board',
            'motherboard' => 'dns',
            'ram'         => 'memory_alt',
            'storage'     => 'hard_drive',
            'psu'         => 'power',
            'base_system' => 'laptop_mac',
        ];
        @endphp

        @forelse($components as $category => $items)
            <div>
                {{-- Category header --}}
                <h4 class="text-[14px] font-medium text-ink-mute uppercase tracking-widest mb-4 flex items-center gap-2.5">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full block"></span>
                    {{ ucwords(str_replace('_', ' ', $category)) }}
                    <span class="text-ink-faint font-normal normal-case tracking-normal">· {{ $items->count() }} item</span>
                </h4>

                {{-- Hardware cards --}}
                <div class="grid grid-cols-1 gap-3">
                    @foreach($items as $item)
                        @php $icon = $categoryIcons[$item->category] ?? 'developer_board'; @endphp
                        <x-hardware-card :item="$item" :icon="$icon" />
                    @endforeach
                </div>
            </div>
        @empty
            <div class="py-24 text-center">
                <div class="w-16 h-16 bg-canvas-soft rounded-full border border-hairline flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined text-[28px] text-ink-faint">inventory_2</span>
                </div>
                <p class="text-[17px] font-medium text-ink mb-2">Tidak ada komponen ditemukan</p>
                <p class="text-[14px] text-ink-mute">Coba pilih kategori yang berbeda.</p>
            </div>
        @endforelse

    </div>
</div>



<script>
(() => {
    const listEl = document.getElementById('component-list');
    if (!listEl) return;

    const setLoading = (active) => {
        listEl.style.opacity       = active ? '0.5' : '';
        listEl.style.pointerEvents = active ? 'none' : '';
    };

    const setActiveLink = (activeLink) => {
        document.querySelectorAll('#sidebar-wrapper a').forEach(a => {
            a.classList.remove('bg-hairline-cool', 'text-ink');
            a.classList.add('text-ink-mute');
        });
        activeLink.classList.add('bg-hairline-cool', 'text-ink');
        activeLink.classList.remove('text-ink-mute');
    };

    document.addEventListener('click', async (e) => {
        const link = e.target.closest('#sidebar-wrapper a[href*="builder"]');
        if (!link) return;

        e.preventDefault();
        const url = link.href;

        setActiveLink(link);
        setLoading(true);

        try {
            const separator = url.includes('?') ? '&' : '?';
            const res       = await fetch(`${url}${separator}_ajax=1`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
            });
            const html    = await res.text();
            const doc     = new DOMParser().parseFromString(html, 'text/html');
            const newList = doc.getElementById('component-list');

            if (newList) {
                listEl.innerHTML = newList.innerHTML;
            }

            history.pushState(null, '', url);
        } catch {
            window.location.href = url;
        } finally {
            setLoading(false);
        }
    });
})();
</script>
@endsection