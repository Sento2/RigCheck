<header class="bg-background/80 backdrop-blur-xl border-b border-outline-variant shadow-sm w-full sticky top-0 z-50 flex justify-between items-center px-8 py-4">
    <div class="flex items-center gap-8">
        <h1 class="font-headline-lg text-[32px] font-bold text-primary tracking-tight">RigCheck</h1>
        <nav class="hidden md:flex gap-6 items-center">
            <a class="text-primary font-bold border-b-2 border-primary pb-1 transition-colors" href="{{ route('builder.index') }}">Katalog</a>
            <a class="text-on-surface-variant hover:text-on-surface transition-colors" href="#">My Garage</a>
        </nav>
    </div>
    <div class="flex items-center gap-4">
        <button class="bg-primary text-on-primary px-6 py-2 rounded-xl font-bold active:scale-95 duration-150 shadow-sm neon-glow-primary text-sm">
            Save Rig
        </button>
        <img alt="User profile" class="w-10 h-10 rounded-full border border-outline-variant object-cover" src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff"/>
    </div>
</header>