<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>RigCheck | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #dfdfdf; border-radius: 10px; }

        /* === Sidebar Hover Mechanic === */
        #sidebar-hover-trigger {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 20px;
            z-index: 50;
            cursor: default;
        }

        #sidebar-wrapper {
            position: absolute;
            top: 0;
            left: -260px; /* Hide sidebar off-screen */
            height: 100%;
            width: 256px; /* w-64 equivalent */
            z-index: 40;
            transition: left 0.25s ease;
        }

        #sidebar-wrapper.sidebar-open {
            left: 0;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.10);
        }

        #sidebar-wrapper aside {
            height: 100%;
        }
    </style>
</head>
<body class="bg-canvas text-ink font-sans overflow-hidden h-screen flex flex-col">

    @include('components.navbar')

    @php
        $path = request()->path();
        $isFullWidth = $path === '/' || $path === 'login' || $path === 'register';
        $isBuilder   = $path === 'builder';
    @endphp

    <div class="flex flex-1 overflow-hidden w-full relative">
        @if(!$isFullWidth)
            {{-- Invisible trigger zone at the very left edge --}}
            <div id="sidebar-hover-trigger"></div>

            {{-- Sidebar: slides in from left on hover --}}
            <div id="sidebar-wrapper">
                @include('components.sidebar')
            </div>
        @endif

        <main class="flex-1 w-full bg-canvas overflow-y-auto custom-scrollbar relative">
            <div class="min-h-full flex flex-col">
                @yield('content')
                
                @if(!$isFullWidth && !$isBuilder)
                    <div class="mt-auto">
                        @include('components.footer')
                    </div>
                @endif
            </div>
        </main>
    </div>

    {{-- Sticky footer hanya untuk halaman Katalog/Builder --}}
    @if($isBuilder)
        <div style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 20;">
            @include('components.footer')
        </div>
    @endif

    @if(!$isFullWidth)
    <script>
        (function() {
            var trigger  = document.getElementById('sidebar-hover-trigger');
            var sidebar  = document.getElementById('sidebar-wrapper');
            if (!trigger || !sidebar) return;

            trigger.addEventListener('mouseenter', function () {
                sidebar.classList.add('sidebar-open');
            });

            sidebar.addEventListener('mouseleave', function () {
                sidebar.classList.remove('sidebar-open');
            });
        })();
    </script>
    @endif

</body>
</html>