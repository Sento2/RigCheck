@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="px-8 py-8 w-full max-w-4xl mx-auto">
    <div class="mb-10">
        <h1 class="text-[32px] font-medium text-ink tracking-tight mb-1">Pengaturan Akun</h1>
        <p class="text-[15px] text-ink-mute leading-[1.5]">Kelola informasi pribadi dan keamanan Anda.</p>
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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Left Column: Avatar & Overview -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)] flex flex-col items-center text-center">
                <div class="w-24 h-24 rounded-full border-4 border-canvas-soft bg-canvas-soft flex items-center justify-center overflow-hidden mb-4 shadow-[0_4px_12px_rgba(0,0,0,0.05)]">
                    <img alt="User profile" class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=171717&color=fff&size=200"/>
                </div>
                <h2 class="text-[20px] font-medium text-ink leading-tight">{{ $user->name }}</h2>
                <p class="text-[14px] text-ink-mute mb-4">{{ $user->email }}</p>
                
                @if($user->role === 'admin')
                    <span class="bg-primary/10 text-primary border border-primary/20 px-3 py-1 rounded-full text-[11px] font-medium uppercase tracking-widest flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">shield</span> Admin
                    </span>
                @else
                    <span class="bg-canvas-soft text-ink-mute border border-hairline px-3 py-1 rounded-full text-[11px] font-medium uppercase tracking-widest">
                        Pengguna Standar
                    </span>
                @endif
            </div>

            <div class="bg-canvas rounded-[12px] border border-hairline p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                <p class="text-[12px] font-medium text-ink-mute uppercase tracking-widest mb-4">Statistik Akun</p>
                <div class="flex items-center justify-between">
                    <span class="text-[14px] text-ink">Total Rakitan Dibuat</span>
                    <span class="text-[18px] font-medium text-ink">{{ $totalRigs }}</span>
                </div>
                <div class="h-px w-full bg-hairline my-3"></div>
                <div class="flex items-center justify-between">
                    <span class="text-[14px] text-ink">Anggota Sejak</span>
                    <span class="text-[14px] font-medium text-ink">{{ $user->created_at->format('M Y') }}</span>
                </div>
            </div>

            <div class="bg-red-50 rounded-[12px] border border-red-200 p-6 shadow-[0_2px_8px_rgba(0,0,0,0.04)]">
                <p class="text-[12px] font-medium text-red-500 uppercase tracking-widest mb-4">Zona Berbahaya</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-[16px] py-[10px] rounded-[6px] font-medium hover:bg-red-600 transition-colors text-[14px] flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Settings Forms -->
        <div class="md:col-span-2 space-y-6">
            <!-- Profile Info Form -->
            <div class="bg-canvas rounded-[12px] border border-hairline shadow-[0_2px_8px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="bg-canvas-soft border-b border-hairline p-5">
                    <h3 class="text-[16px] font-medium text-ink">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Nama Lengkap</label>
                            <input name="name" type="text" value="{{ old('name', $user->name) }}" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                        </div>
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Alamat Email</label>
                            <input name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                        </div>
                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="bg-ink text-canvas px-[20px] py-[10px] rounded-[6px] font-medium hover:bg-ink-secondary transition-colors text-[14px]">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Form -->
            <div class="bg-canvas rounded-[12px] border border-hairline shadow-[0_2px_8px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="bg-canvas-soft border-b border-hairline p-5">
                    <h3 class="text-[16px] font-medium text-ink">Keamanan & Kata Sandi</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Kata Sandi Saat Ini</label>
                            <input name="current_password" type="password" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                        </div>
                        <div class="h-px w-full bg-hairline my-2"></div>
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Kata Sandi Baru</label>
                            <input name="password" type="password" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                            <p class="text-[12px] text-ink-mute mt-1">Minimal harus 8 karakter.</p>
                        </div>
                        <div>
                            <label class="block text-[13px] font-medium text-ink mb-1.5">Konfirmasi Kata Sandi Baru</label>
                            <input name="password_confirmation" type="password" required class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[14px] focus:outline-none focus:border-hairline-strong">
                        </div>
                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="bg-ink text-canvas px-[20px] py-[10px] rounded-[6px] font-medium hover:bg-ink-secondary transition-colors text-[14px]">
                                Perbarui Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
