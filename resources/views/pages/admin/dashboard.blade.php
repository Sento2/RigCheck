@extends('layouts.app')

@section('title', 'Garasi Saya')

@section('content')
<div class="px-8 py-8 w-full max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-[36px] font-medium text-ink tracking-[-0.72px] mb-1">Garasi Saya</h1>
            <p class="text-[15px] text-ink-mute">Kelola dan simpan rakitan PC Anda.</p>
        </div>
        <a href="{{ route('builder.index') }}"
           class="bg-primary text-on-primary px-[16px] py-[9px] rounded-[8px] font-medium hover:bg-primary-deep transition-colors flex items-center gap-2 text-[14px] shadow-[0_2px_8px_rgba(62,207,142,0.3)]">
            <span class="material-symbols-outlined text-[18px]">add</span> Rakit PC Baru
        </a>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-8 p-4 bg-primary/10 border border-primary/30 rounded-[8px] flex items-center gap-3">
            <span class="material-symbols-outlined text-primary">check_circle</span>
            <p class="text-[14px] font-medium text-ink">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-[8px] flex items-center gap-3">
            <span class="material-symbols-outlined text-red-500">error</span>
            <p class="text-[14px] font-medium text-ink">{{ session('error') }}</p>
        </div>
    @endif

    @forelse($rigs as $rig)
        @php
            $calcWattage = $rig->components->sum(fn($c) => $c->wattage * ($c->pivot->quantity ?? 1));
            $calcPrice   = $rig->components->sum(fn($c) => $c->price  * ($c->pivot->quantity ?? 1));
            $isDraft     = !$rig->is_completed;
        @endphp

        <div class="mb-8 bg-canvas border border-hairline rounded-[12px] overflow-hidden shadow-[0_1px_4px_rgba(0,0,0,0.05)]">

            {{-- Rig Header --}}
            <div class="bg-canvas-soft border-b border-hairline px-6 py-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <h3 class="text-[19px] font-medium text-ink tracking-tight">{{ $rig->name }}</h3>
                        @if($isDraft)
                            <span class="bg-amber-100 text-amber-700 text-[10px] px-2 py-0.5 rounded-full uppercase font-medium tracking-wider border border-amber-200">
                                Draft
                            </span>
                        @else
                            <span class="bg-primary/10 text-primary text-[10px] px-2 py-0.5 rounded-full uppercase font-medium tracking-wider border border-primary/20">
                                Tersimpan
                            </span>
                        @endif
                    </div>
                    <p class="text-[12px] text-ink-mute font-mono">
                        {{ $rig->components->count() }} komponen · Dibuat {{ $rig->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    {{-- Stats --}}
                    <div class="bg-canvas border border-hairline rounded-[8px] px-4 py-2 flex flex-col justify-center min-w-[100px]">
                        <p class="text-[10px] text-ink-mute uppercase tracking-widest font-medium mb-0.5">Daya</p>
                        <p class="text-[17px] font-medium text-ink leading-tight">{{ $calcWattage }} <span class="text-[11px] text-ink-mute">W</span></p>
                    </div>
                    <div class="bg-canvas-night border border-hairline rounded-[8px] px-4 py-2 flex flex-col justify-center min-w-[140px]">
                        <p class="text-[10px] text-on-dark/60 uppercase tracking-widest font-medium mb-0.5">Est. Biaya</p>
                        <p class="text-[17px] font-medium text-on-dark leading-tight"><span class="text-[11px] text-on-dark/60">Rp</span> {{ number_format($calcPrice, 0, ',', '.') }}</p>
                    </div>

                    {{-- Action buttons --}}
                    <div class="flex items-center gap-2">
                        @if($isDraft)
                            {{-- Tombol Simpan Rakitan --}}
                            <button onclick="openSaveModal({{ $rig->id }}, '{{ addslashes($rig->name) }}')"
                                    class="bg-primary text-on-primary px-[14px] py-[9px] rounded-[8px] font-medium text-[13px] hover:bg-primary-deep transition-colors flex items-center gap-1.5 shadow-[0_2px_8px_rgba(62,207,142,0.3)]">
                                <span class="material-symbols-outlined text-[16px]">save</span>
                                Simpan Rakitan
                            </button>
                        @endif

                        {{-- Tombol Analisis --}}
                        @if($rig->components->count() > 0)
                            <a href="{{ route('compatibility.index', $rig->id) }}"
                               class="border border-hairline-strong bg-canvas text-ink px-[14px] py-[9px] rounded-[8px] font-medium text-[13px] hover:bg-hairline-cool transition-colors flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px]">analytics</span>
                                Analisis AI
                            </a>
                        @endif

                        {{-- Tombol Hapus --}}
                        <button onclick="confirmDelete({{ $rig->id }}, '{{ addslashes($rig->name) }}')"
                                class="border border-hairline text-ink-mute hover:text-red-500 hover:bg-red-50 hover:border-red-200 p-[9px] rounded-[8px] transition-colors"
                                title="Hapus Rakitan">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Components Table --}}
            @if($rig->components->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-hairline bg-canvas">
                                <th class="py-3 px-6 text-[11px] font-medium text-ink-mute uppercase tracking-widest">Komponen</th>
                                <th class="py-3 px-6 text-[11px] font-medium text-ink-mute uppercase tracking-widest">Kategori</th>
                                <th class="py-3 px-6 text-[11px] font-medium text-ink-mute uppercase tracking-widest text-right">Harga</th>
                                @if($isDraft)
                                    <th class="py-3 px-6 text-[11px] font-medium text-ink-mute uppercase tracking-widest text-right">Hapus</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-hairline">
                            @foreach($rig->components as $component)
                                <tr class="bg-canvas hover:bg-canvas-soft transition-colors group">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-9 h-9 bg-canvas-soft rounded-[6px] border border-hairline flex items-center justify-center text-ink-mute shrink-0">
                                                <span class="material-symbols-outlined text-[18px]">developer_board</span>
                                            </div>
                                            <div>
                                                <p class="text-[14px] font-medium text-ink">{{ $component->name }}</p>
                                                <p class="text-[11px] text-ink-mute font-mono mt-0.5">{{ $component->wattage }}W</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="bg-canvas-night text-on-dark text-[11px] px-2 py-0.5 rounded-[4px] uppercase font-medium">
                                            {{ $component->category }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <span class="text-[14px] font-medium text-ink">Rp {{ number_format($component->price, 0, ',', '.') }}</span>
                                    </td>
                                    @if($isDraft)
                                        <td class="py-4 px-6 text-right">
                                            <form action="{{ route('rigs.remove_component') }}" method="POST" class="inline-block m-0 p-0">
                                                @csrf
                                                <input type="hidden" name="rig_id" value="{{ $rig->id }}">
                                                <input type="hidden" name="component_id" value="{{ $component->id }}">
                                                <button type="submit"
                                                        class="text-ink-mute hover:text-red-500 hover:bg-red-50 p-1.5 rounded-[6px] transition-colors"
                                                        title="Hapus dari rakitan">
                                                    <span class="material-symbols-outlined text-[18px]">remove_circle</span>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-14 h-14 bg-canvas-soft rounded-full border border-hairline flex items-center justify-center mx-auto mb-4">
                        <span class="material-symbols-outlined text-[24px] text-ink-faint">shopping_cart</span>
                    </div>
                    <p class="text-[15px] font-medium text-ink mb-1">Keranjang kosong</p>
                    <p class="text-[13px] text-ink-mute mb-5">Tambahkan komponen dari katalog.</p>
                    <a href="{{ route('builder.index') }}" class="text-primary font-medium hover:underline text-[13px]">Buka Katalog →</a>
                </div>
            @endif
        </div>
    @empty
        <div class="py-24 text-center bg-canvas border border-hairline rounded-[12px]">
            <div class="w-16 h-16 bg-canvas-soft rounded-full border border-hairline flex items-center justify-center mx-auto mb-5">
                <span class="material-symbols-outlined text-[28px] text-ink-faint">garage</span>
            </div>
            <p class="text-[18px] font-medium text-ink mb-2">Garasi Anda masih kosong</p>
            <p class="text-[14px] text-ink-mute mb-6">Mulai tambah komponen dari katalog untuk membangun rakitan pertama Anda.</p>
            <a href="{{ route('builder.index') }}"
               class="bg-primary text-on-primary px-[20px] py-[10px] rounded-[8px] font-medium text-[14px] hover:bg-primary-deep transition-colors inline-block">
                Mulai Merakit
            </a>
        </div>
    @endforelse
</div>

{{-- ══ Modal: Simpan Rakitan ══ --}}
<div id="save-modal" class="fixed inset-0 z-[100] hidden items-center justify-center">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeSaveModal()"></div>

    {{-- Modal panel --}}
    <div class="relative bg-canvas rounded-[16px] border border-hairline shadow-[0_20px_60px_rgba(0,0,0,0.15)] p-8 w-full max-w-md mx-4 animate-fade-up">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[20px]">save</span>
            </div>
            <div>
                <h3 class="text-[17px] font-medium text-ink">Simpan Rakitan</h3>
                <p class="text-[13px] text-ink-mute">Beri nama rakitan Anda sebelum disimpan.</p>
            </div>
        </div>

        <form id="save-form" method="POST">
            @csrf
            <div class="mb-6">
                <label for="rig-name-input" class="block text-[13px] font-medium text-ink mb-2">Nama Rakitan</label>
                <input id="rig-name-input"
                       name="name"
                       type="text"
                       placeholder="Contoh: Gaming Rig 2025"
                       maxlength="255"
                       required
                       class="w-full bg-canvas border border-hairline rounded-[8px] px-[12px] py-[10px] text-[15px] text-ink focus:outline-none focus:border-primary transition-colors">
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="flex-1 bg-primary text-on-primary py-[10px] rounded-[8px] font-medium text-[14px] hover:bg-primary-deep transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                    Simpan
                </button>
                <button type="button"
                        onclick="closeSaveModal()"
                        class="flex-1 bg-canvas border border-hairline text-ink py-[10px] rounded-[8px] font-medium text-[14px] hover:bg-hairline-cool transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ══ Modal: Konfirmasi Hapus ══ --}}
<div id="delete-modal" class="fixed inset-0 z-[100] hidden items-center justify-center">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDeleteModal()"></div>

    <div class="relative bg-canvas rounded-[16px] border border-hairline shadow-[0_20px_60px_rgba(0,0,0,0.15)] p-8 w-full max-w-sm mx-4 animate-fade-up">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-red-500 text-[20px]">warning</span>
            </div>
            <div>
                <h3 class="text-[17px] font-medium text-ink">Hapus Rakitan?</h3>
                <p id="delete-modal-desc" class="text-[13px] text-ink-mute">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
        </div>

        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="flex-1 bg-red-500 text-white py-[10px] rounded-[8px] font-medium text-[14px] hover:bg-red-600 transition-colors flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">delete</span>
                    Ya, Hapus
                </button>
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="flex-1 bg-canvas border border-hairline text-ink py-[10px] rounded-[8px] font-medium text-[14px] hover:bg-hairline-cool transition-colors">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ── Modal: Simpan ──
    function openSaveModal(rigId, currentName) {
        const modal = document.getElementById('save-modal');
        const form  = document.getElementById('save-form');
        const input = document.getElementById('rig-name-input');

        form.action = `/rigs/${rigId}/save`;
        input.value = currentName.replace(/^Project Rig - \d{4}-\d{2}-\d{2}$/, '');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => input.focus(), 100);
    }

    function closeSaveModal() {
        const modal = document.getElementById('save-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ── Modal: Hapus ──
    function confirmDelete(rigId, rigName) {
        const modal = document.getElementById('delete-modal');
        const form  = document.getElementById('delete-form');
        const desc  = document.getElementById('delete-modal-desc');

        form.action = `/rigs/${rigId}`;
        desc.textContent = `"${rigName}" akan dihapus permanen.`;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Tutup modal dengan Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeSaveModal();
            closeDeleteModal();
        }
    });
</script>

@endsection