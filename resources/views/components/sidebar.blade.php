<aside class="h-screen w-64 bg-surface-container-low flex flex-col gap-1 fixed left-0 top-0 pt-20 custom-scrollbar overflow-y-auto z-10 border-r border-outline-variant">
    <div class="px-6 py-4 mt-4">
        <h2 class="font-headline-lg-mobile text-xl font-bold text-primary">Kategori</h2>
        <p class="text-on-surface-variant text-sm">Filter komponen rakitan</p>
    </div>
    <nav class="flex flex-col gap-1 pr-4">
        @php
            $sidebarCategories = [
                'base_system' => ['label' => 'Base System / Laptop', 'icon' => 'laptop_mac'],
                'cpu' => ['label' => 'Processors', 'icon' => 'memory'],
                'gpu' => ['label' => 'Graphics Cards', 'icon' => 'developer_board'],
                'ram' => ['label' => 'Memory', 'icon' => 'memory_alt'],
                'storage' => ['label' => 'Storage', 'icon' => 'storage'],
                'motherboard' => ['label' => 'Motherboards', 'icon' => 'grid_view'],
            ];
        @endphp

        @foreach($sidebarCategories as $key => $data)
            <div class="text-on-surface-variant hover:bg-surface-container-high rounded-r-full flex items-center gap-4 px-6 py-3 cursor-pointer transition-all group">
                <span class="material-symbols-outlined group-hover:text-primary transition-colors">{{ $data['icon'] }}</span>
                <span class="font-label-tech text-xs uppercase tracking-wider">{{ $data['label'] }}</span>
            </div>
        @endforeach
    </nav>
</aside>