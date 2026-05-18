@extends('layouts.app')

@section('title', 'Admin Command Center')

@section('content')
<div class="px-8 py-8 w-full mx-auto">
    
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-[32px] font-medium text-ink tracking-tight mb-1">Pusat Kendali Admin</h1>
            <p class="text-[15px] text-ink-mute leading-[1.5]">Kelola katalog Hardware, pantau metrik, dan awasi platform.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-primary-soft/10 border border-primary/20 rounded-[8px] flex items-center gap-3 text-ink">
            <span class="material-symbols-outlined text-primary">check_circle</span>
            <p class="text-[14px] font-medium">{{ session('success') }}</p>
        </div>
    @endif
    
    @if($errors->any())
        <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-[8px] flex items-start gap-3">
            <span class="material-symbols-outlined text-red-500">error</span>
            <ul class="text-[14px] text-red-700 font-medium">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest">Total Hardware</p>
                <span class="material-symbols-outlined text-[20px] text-ink-mute">inventory_2</span>
            </div>
            <p class="text-[36px] font-medium text-ink tracking-tight leading-none">{{ $totalComponents }} <span class="text-[14px] text-ink-mute tracking-normal">ITEMS</span></p>
        </div>

        <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest">Pengguna Aktif</p>
                <span class="material-symbols-outlined text-[20px] text-ink-mute">group</span>
            </div>
            <p class="text-[36px] font-medium text-ink tracking-tight leading-none">{{ $totalUsers }} <span class="text-[14px] text-ink-mute tracking-normal">PENGGUNA</span></p>
        </div>

        <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest">Total Rakitan</p>
                <span class="material-symbols-outlined text-[20px] text-ink-mute">computer</span>
            </div>
            <p class="text-[36px] font-medium text-ink tracking-tight leading-none">{{ $totalRigs }} <span class="text-[14px] text-ink-mute tracking-normal">RIGS</span></p>
        </div>

        <div class="bg-canvas-night rounded-[12px] border border-hairline-strong p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <p class="text-[12px] font-medium text-on-dark/70 uppercase tracking-widest">Node Database</p>
                <span class="material-symbols-outlined text-[20px] text-on-dark/70">dns</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-3 h-3 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(62,207,142,0.6)]"></div>
                <p class="text-[14px] font-medium text-on-dark uppercase tracking-widest">TERHUBUNG</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Add Hardware Form (Left, 1 Col) -->
        <div class="bg-canvas rounded-[12px] border border-hairline shadow-[0_2px_8px_rgba(0,0,0,0.04)] overflow-hidden h-fit">
            <div class="bg-canvas-soft border-b border-hairline p-5">
                <h3 class="text-[16px] font-medium text-ink">Tambah Hardware Baru</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.hardware.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[13px] font-medium text-ink mb-1.5">Nama Komponen <span class="text-red-500">*</span></label>
                        <input name="name" type="text" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                                <option value="cpu">CPU</option>
                                <option value="gpu">GPU</option>
                                <option value="motherboard">Motherboard</option>
                                <option value="ram">RAM</option>
                                <option value="storage">Storage</option>
                                <option value="psu">Power Supply</option>
                                <option value="base_system">Base System</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Daya (W) <span class="text-red-500">*</span></label>
                            <input name="wattage" type="number" min="0" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[13px] font-medium text-ink mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input name="price" type="number" min="0" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                    </div>

                    <div class="border-t border-hairline pt-5 mt-5">
                        <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4">Spesifikasi (Opsional)</p>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-[12px] text-ink-mute mb-1">Soket</label>
                                <input name="socket" type="text" placeholder="e.g. AM5" class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-1.5 text-[13px] focus:outline-none focus:border-hairline-strong">
                            </div>
                            <div>
                                <label class="block text-[12px] text-ink-mute mb-1">Chipset</label>
                                <input name="chipset" type="text" placeholder="e.g. B650" class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-1.5 text-[13px] focus:outline-none focus:border-hairline-strong">
                            </div>
                            <div>
                                <label class="block text-[12px] text-ink-mute mb-1">RAM Type</label>
                                <input name="ram_type" type="text" placeholder="e.g. DDR5" class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-1.5 text-[13px] focus:outline-none focus:border-hairline-strong">
                            </div>
                            <div>
                                <label class="block text-[12px] text-ink-mute mb-1">Capacity</label>
                                <input name="capacity" type="text" placeholder="e.g. 16GB" class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-1.5 text-[13px] focus:outline-none focus:border-hairline-strong">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary text-on-primary px-[16px] py-[10px] rounded-[6px] font-medium hover:bg-primary-deep transition-colors text-[14px]">
                        Simpan Hardware
                    </button>
                </form>
            </div>
        </div>

        <!-- Latest Catalog (Right, 2 Cols) -->
        <div class="lg:col-span-2 bg-canvas rounded-[12px] border border-hairline shadow-[0_2px_8px_rgba(0,0,0,0.04)] h-fit">
            <div class="bg-canvas-soft border-b border-hairline p-5 flex justify-between items-center">
                <h3 class="text-[16px] font-medium text-ink">Hardware Baru Ditambahkan</h3>
                <a href="{{ route('builder.index') }}" class="text-[13px] text-primary hover:underline font-medium">Lihat Katalog Lengkap</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-canvas text-[12px] font-medium text-ink-mute uppercase tracking-widest border-b border-hairline">
                            <th class="py-3 px-5">Nama</th>
                            <th class="py-3 px-5">Kategori</th>
                            <th class="py-3 px-5">Harga</th>
                            <th class="py-3 px-5 text-center">Daya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hairline">
                        @forelse($latestComponents as $comp)
                            <tr class="hover:bg-canvas-soft transition-colors group">
                                <td class="py-3 px-5 text-[14px] font-medium text-ink">{{ $comp->name }}</td>
                                <td class="py-3 px-5">
                                    <span class="bg-canvas-night text-on-dark px-2 py-0.5 rounded-[4px] text-[10px] uppercase font-medium tracking-wider">{{ $comp->category }}</span>
                                </td>
                                <td class="py-3 px-5 text-[14px] text-ink">Rp {{ number_format($comp->price, 0, ',', '.') }}</td>
                                <td class="py-3 px-5 text-[14px] text-ink-mute text-center font-mono">{{ $comp->wattage }}W</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-[14px] text-ink-mute">Tidak ada hardware ditemukan di katalog.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
