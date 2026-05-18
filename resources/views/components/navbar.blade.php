<header id="main-navbar" class="bg-canvas/95 backdrop-blur-sm border-b border-hairline w-full sticky top-0 z-50 flex justify-between items-center px-6 transition-shadow duration-200"
        style="height: 56px;">
    <div class="flex items-center gap-8">
        <a href="{{ route('landing') }}" class="text-[20px] font-medium text-ink tracking-tight flex items-center gap-2 hover:opacity-80 transition-opacity">
            <span class="w-2.5 h-2.5 bg-primary rounded-full block animate-pulse-green"></span>
            RigCheck
        </a>
        <nav class="hidden md:flex gap-1 items-center">
            <a class="px-3 py-1.5 rounded-[6px] text-[14px] font-medium transition-all
                      {{ request()->routeIs('builder.index') ? 'bg-hairline-cool text-ink' : 'text-ink-mute hover:text-ink hover:bg-hairline-cool-2' }}"
               href="{{ route('builder.index') }}">Katalog</a>
            <a class="px-3 py-1.5 rounded-[6px] text-[14px] font-medium transition-all
                      {{ request()->routeIs('dashboard') ? 'bg-hairline-cool text-ink' : 'text-ink-mute hover:text-ink hover:bg-hairline-cool-2' }}"
               href="{{ route('dashboard') }}">Garasi Saya</a>
            <a class="px-3 py-1.5 rounded-[6px] text-[14px] font-medium transition-all
                      {{ request()->routeIs('autobuilder.index') ? 'bg-hairline-cool text-ink' : 'text-ink-mute hover:text-ink hover:bg-hairline-cool-2' }}"
               href="{{ route('autobuilder.index') }}">Auto Builder</a>
        </nav>
    </div>

    <div class="flex items-center gap-3">
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-1.5 text-[13px] font-medium text-ink-mute hover:text-ink transition-colors px-3 py-1.5 rounded-[6px] hover:bg-hairline-cool-2">
                    <span class="material-symbols-outlined text-[17px]">admin_panel_settings</span>
                    Admin Panel
                </a>
            @endif
            <a href="{{ route('dashboard') }}"
               class="bg-canvas-night text-on-dark px-[14px] py-[7px] rounded-[6px] font-medium text-[13px] hover:bg-canvas-night-soft transition-colors">
                Ke Dashboard
            </a>
            <a href="{{ route('profile.index') }}"
               class="w-8 h-8 rounded-full border-2 border-hairline bg-canvas-soft flex items-center justify-center overflow-hidden hover:border-primary transition-colors">
                <img alt="Foto profil"
                     class="w-full h-full object-cover"
                     src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=171717&color=fff"/>
            </a>
        @else
            <a href="{{ route('login') }}"
               class="text-[14px] font-medium text-ink-mute hover:text-ink transition-colors px-3 py-1.5 rounded-[6px] hover:bg-hairline-cool-2">Sign In</a>
            <a href="{{ route('register') }}"
               class="bg-primary text-on-primary px-[14px] py-[7px] rounded-[6px] font-medium text-[13px] hover:bg-primary-deep transition-colors shadow-[0_1px_4px_rgba(62,207,142,0.3)]">
                Daftar Gratis
            </a>
        @endauth
    </div>
</header>

<script>
    (() => {
        const navbar = document.getElementById('main-navbar');
        const onScroll = () => {
            navbar.style.boxShadow = window.scrollY > 10
                ? '0 1px 16px rgba(0,0,0,0.07)'
                : 'none';
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    })();
</script>