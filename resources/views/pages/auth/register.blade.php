@extends('layouts.app')

@section('title', 'Register - RigCheck')

@section('content')
<div class="min-h-[calc(100vh-80px)] w-full flex items-center justify-center bg-canvas-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-canvas rounded-[12px] border border-hairline shadow-[0_8px_24px_rgba(0,0,0,0.06)] p-8">
        
        <div class="text-center mb-8">
            <h2 class="text-[28px] font-medium text-ink tracking-[-0.42px] mb-2">Buat Akun</h2>
            <p class="text-[14px] text-ink-mute">Bergabung dengan RigCheck untuk menyimpan rakitan Anda.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-[8px] flex items-start gap-3">
                <span class="material-symbols-outlined text-red-500">error</span>
                <ul class="text-[14px] text-red-700 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-[14px] font-medium text-ink mb-1.5">Nama Lengkap</label>
                <input id="name" name="name" type="text" autocomplete="name" required 
                    class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[16px] text-ink focus:outline-none focus:border-hairline-strong transition-colors"
                    placeholder="John Doe">
            </div>

            <div>
                <label for="email" class="block text-[14px] font-medium text-ink mb-1.5">Alamat Email</label>
                <input id="email" name="email" type="email" autocomplete="email" required 
                    pattern=".*@.*" title="Email must contain an '@' symbol."
                    class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 text-[16px] text-ink focus:outline-none focus:border-hairline-strong transition-colors"
                    placeholder="you@example.com">
            </div>

            <div>
                <label for="password" class="block text-[14px] font-medium text-ink mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <input id="password" name="password" type="password" autocomplete="new-password" required 
                        class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 pr-10 text-[16px] text-ink focus:outline-none focus:border-hairline-strong transition-colors"
                        placeholder="••••••••">
                    <button type="button" onclick="(function() { const pwd = document.getElementById('password'); const icon = this.querySelector('span'); if(pwd.type === 'password'){ pwd.type = 'text'; icon.innerText = 'visibility_off'; } else { pwd.type = 'password'; icon.innerText = 'visibility'; } }).call(this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-ink-mute hover:text-ink">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                    </button>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-[14px] font-medium text-ink mb-1.5">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                        class="w-full bg-canvas border border-hairline rounded-[6px] px-3 py-2 pr-10 text-[16px] text-ink focus:outline-none focus:border-hairline-strong transition-colors"
                        placeholder="••••••••">
                    <button type="button" onclick="(function() { const pwd = document.getElementById('password_confirmation'); const icon = this.querySelector('span'); if(pwd.type === 'password'){ pwd.type = 'text'; icon.innerText = 'visibility_off'; } else { pwd.type = 'password'; icon.innerText = 'visibility'; } }).call(this)" class="absolute inset-y-0 right-0 pr-3 flex items-center text-ink-mute hover:text-ink">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                    </button>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-[6px] text-[14px] font-medium text-on-primary bg-primary hover:bg-primary-deep transition-colors focus:outline-none">
                    Buat Akun
                </button>
            </div>
        </form>

        <div class="mt-8 text-center text-[14px] text-ink-mute">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-medium text-ink hover:underline">Sign in</a>
        </div>
    </div>
</div>
@endsection