<aside class="w-64 flex-shrink-0 bg-canvas-soft flex flex-col h-full border-r border-hairline overflow-y-auto custom-scrollbar z-10 relative">
    <div class="px-6 py-6">
        <h2 class="text-[12px] font-medium text-ink-mute uppercase tracking-widest">Kategori Hardware</h2>
    </div>
    <nav class="flex flex-col px-3 gap-1">
        @php
            $sidebarCategories = [
                '' => ['label' => 'Semua Kategori', 'icon' => 'grid_view'],
                'cpu' => ['label' => 'Processors', 'icon' => 'memory'],
                'gpu' => ['label' => 'Graphics Cards', 'icon' => 'developer_board'],
                'motherboard' => ['label' => 'Motherboards', 'icon' => 'dns'],
                'ram' => ['label' => 'Memory', 'icon' => 'memory_alt'],
                'storage' => ['label' => 'Storage', 'icon' => 'storage'],
                'psu' => ['label' => 'Power Supply', 'icon' => 'power'],
                'base_system' => ['label' => 'Base System', 'icon' => 'laptop_mac'],
            ];
            $currentCategory = request()->query('category', '');
        @endphp

        @foreach($sidebarCategories as $key => $data)
            <a href="{{ route('builder.index', ['category' => $key]) }}" 
               class="flex items-center gap-3 px-3 py-2 rounded-[6px] transition-colors {{ $currentCategory === $key ? 'bg-hairline-cool text-ink' : 'text-ink-mute hover:bg-hairline-cool-2 hover:text-ink' }}">
                <span class="material-symbols-outlined text-[18px]">{{ $data['icon'] }}</span>
                <span class="text-[14px]">{{ $data['label'] }}</span>
            </a>
        @endforeach
    </nav>
</aside>