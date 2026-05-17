@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="glass-card border border-outline-variant p-10 rounded-xl shadow-2xl premium-shadow">
    <header class="mb-10 text-center">
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-lg">
                <span class="material-symbols-outlined text-on-primary" style="font-variation-settings: 'FILL' 1;">terminal</span>
            </div>
        </div>
        <h1 class="font-headline-lg text-[32px] font-bold text-white tracking-tight mb-1">RigCheck</h1>
        <p class="font-body-md text-on-surface-variant">Access your hardware garage</p>
    </header>

    <form method="POST" action="{{ url('/login') }}" class="space-y-6">
        @csrf
        
        <div class="group">
            <label class="block font-label-tech text-[12px] text-on-surface-variant mb-2 ml-1" for="email">
                EMAIL ADDRESS
            </label>
            <div class="relative clean-focus transition-all duration-300 border border-outline-variant bg-surface-container-lowest rounded-lg overflow-hidden">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">alternate_email</span>
                </div>
                <input class="block w-full pl-[48px] pr-4 py-3 bg-transparent border-none text-on-surface font-label-tech focus:ring-0 placeholder:text-slate-600 outline-none" 
                    id="email" name="email" value="test@example.com" type="email" required/>
            </div>
        </div>

        <div class="group">
            <label class="block font-label-tech text-[12px] text-on-surface-variant mb-2 ml-1" for="password">
                PASSWORD
            </label>
            <div class="relative clean-focus transition-all duration-300 border border-outline-variant bg-surface-container-lowest rounded-lg overflow-hidden">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">key</span>
                </div>
                <input class="block w-full pl-[48px] pr-4 py-3 bg-transparent border-none text-on-surface font-label-tech focus:ring-0 placeholder:text-slate-600 outline-none" 
                    id="password" name="password" value="password" type="password" required/>
            </div>
        </div>

        <div class="flex items-center justify-between py-2">
            <label class="flex items-center space-x-2 cursor-pointer group">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-outline-variant bg-surface-container-lowest text-white focus:ring-white focus:ring-offset-background checked:bg-white checked:text-black"/>
                <span class="font-body-sm text-[14px] text-on-surface-variant group-hover:text-on-surface transition-colors">Remember Me</span>
            </label>
            <a class="font-body-sm text-[14px] text-secondary hover:text-secondary-fixed transition-colors hover:underline" href="#">
                Forgot Password?
            </a>
        </div>

        <button class="w-full bg-white hover:bg-slate-200 active:scale-[0.98] transition-all duration-200 py-4 px-10 rounded-lg text-black font-extrabold flex items-center justify-center space-x-4 mt-4 shadow-md" type="submit">
            <span class="font-label-tech text-[12px] tracking-widest">INITIALIZE LOGIN</span>
            <span class="material-symbols-outlined text-[18px]">bolt</span>
        </button>
    </form>

    <footer class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
        <p class="font-body-sm text-[14px] text-on-surface-variant">
            Don't have an account? 
            <a class="text-white font-bold ml-1 hover:underline decoration-white decoration-2 underline-offset-4" href="{{ url('/register') }}">
                Create one
            </a>
        </p>
    </footer>
</div>
@endsection