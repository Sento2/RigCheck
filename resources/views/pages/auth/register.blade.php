@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="fixed inset-0 w-full h-full flex items-center justify-center p-4 md:p-8 z-10 overflow-y-auto custom-scrollbar">
    <main class="w-full max-w-5xl h-full max-h-[650px] grid grid-cols-1 md:grid-cols-2 rounded-xl overflow-hidden shadow-2xl border border-outline-variant bg-surface-container relative premium-shadow">
        
        <section class="flex flex-col justify-center p-6 lg:p-10 bg-surface-container overflow-y-auto custom-scrollbar">
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-white text-3xl" style="font-variation-settings: 'FILL' 1;">developer_board</span>
                    <h2 class="font-headline-lg text-2xl font-bold text-white tracking-tight">RigCheck</h2>
                </div>
                <h1 class="font-headline-xl text-3xl font-bold text-on-surface mb-1 leading-tight">Join RigCheck</h1>
                <p class="font-body-md text-sm text-on-surface-variant">Start building your dream PC today</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <div class="space-y-1">
                    <label class="font-label-tech text-[11px] text-on-surface-variant flex items-center gap-2" for="name">
                        <span class="material-symbols-outlined text-[14px]">person</span>
                        Full Name
                    </label>
                    <input class="w-full bg-background border border-outline-variant rounded-lg p-3 text-on-surface placeholder:text-slate-600 transition-all duration-200 focus:outline-none focus:border-white focus:ring-1 focus:ring-white text-sm outline-none" 
                        id="name" name="name" type="text" placeholder="Enter your full name" required autofocus/>
                </div>
                
                <div class="space-y-1">
                    <label class="font-label-tech text-[11px] text-on-surface-variant flex items-center gap-2" for="email">
                        <span class="material-symbols-outlined text-[14px]">mail</span>
                        Email Address
                    </label>
                    <input class="w-full bg-background border border-outline-variant rounded-lg p-3 text-on-surface placeholder:text-slate-600 transition-all duration-200 focus:outline-none focus:border-white focus:ring-1 focus:ring-white text-sm outline-none" 
                        id="email" name="email" type="email" placeholder="name@example.com" required/>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="font-label-tech text-[11px] text-on-surface-variant flex items-center gap-2" for="password">
                            <span class="material-symbols-outlined text-[14px]">lock</span>
                            Password
                        </label>
                        <input class="w-full bg-background border border-outline-variant rounded-lg p-3 text-on-surface placeholder:text-slate-600 transition-all duration-200 focus:outline-none focus:border-white focus:ring-1 focus:ring-white text-sm outline-none" 
                            id="password" name="password" type="password" placeholder="••••••••" required/>
                    </div>
                    <div class="space-y-1">
                        <label class="font-label-tech text-[11px] text-on-surface-variant flex items-center gap-2" for="password_confirmation">
                            <span class="material-symbols-outlined text-[14px]">verified_user</span>
                            Confirm Password
                        </label>
                        <input class="w-full bg-background border border-outline-variant rounded-lg p-3 text-on-surface placeholder:text-slate-600 transition-all duration-200 focus:outline-none focus:border-white focus:ring-1 focus:ring-white text-sm outline-none" 
                               id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required/>
                    </div>
                </div>
                
                <div class="flex items-start gap-2 py-1">
                    <div class="flex items-center h-5">
                        <input class="w-4 h-4 bg-background border-outline-variant rounded text-white focus:ring-white focus:ring-offset-background checked:bg-white checked:text-black cursor-pointer" id="terms" type="checkbox" required/>
                    </div>
                    <label class="font-body-sm text-xs text-on-surface-variant leading-tight" for="terms">
                        I agree to the <a class="text-white hover:underline transition-all font-semibold" href="#">Terms of Service</a> and <a class="text-white hover:underline transition-all font-semibold" href="#">Privacy Policy</a>.
                    </label>
                </div>
                
                <button class="w-full bg-white hover:bg-slate-200 text-black font-extrabold py-3 mt-1 rounded-lg flex items-center justify-center gap-2 transition-all duration-200 active:scale-95 shadow-md tracking-wider text-sm" type="submit">
                    CREATE ACCOUNT
                    <span class="material-symbols-outlined text-[18px]">rocket_launch</span>
                </button>
            </form>
            
            <footer class="mt-6 pt-4 border-t border-outline-variant text-center">
                <p class="font-body-sm text-xs text-on-surface-variant">
                    Already have an account? 
                    <a class="text-white font-bold hover:underline underline-offset-4 ml-1" href="{{ url('/login') }}">Sign in here</a>
                </p>
            </footer>
        </section>
        
        <section class="hidden md:block relative overflow-hidden group bg-surface-dim">
            <div class="absolute inset-0 bg-gradient-to-br from-white/5 via-transparent to-slate-900/5 pointer-events-none z-10"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8 z-20 bg-gradient-to-t from-background/90 to-transparent">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-highest/80 backdrop-blur-md border border-outline-variant rounded-full mb-3">
                    <span class="material-symbols-outlined text-white text-xs animate-pulse" style="font-variation-settings: 'FILL' 1;">psychology</span>
                    <span class="font-label-tech text-[10px] text-white tracking-wider">AI-POWERED OPTIMIZATION</span>
                </div>
                <h3 class="font-headline-lg text-2xl font-bold text-white mb-1">Advanced Diagnostics</h3>
                <p class="font-body-sm text-xs text-on-surface-variant">Precision engineering for the next generation of performance enthusiasts.</p>
            </div>
            <img alt="RigCheck Tech Visual" class="w-full h-full object-cover grayscale-[0.4] group-hover:scale-105 transition-transform duration-[3000ms] ease-out opacity-30" src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?q=80&w=1920&auto=format&fit=crop" />
        </section>
    </main>
</div>
@endsection