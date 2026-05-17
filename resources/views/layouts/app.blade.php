<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>RigCheck | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Geist:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "primary": "#ffffff",          /* Putih Bersih untuk Aksen & Teks Utama */
                      "on-primary": "#0a0f1d",       /* Hitam Pekat untuk Kontras */
                      "background": "#0a0f1d",       /* Jet Black / Midnight Navy Base */
                      "surface": "#131b2e",          /* Deep Navy Blue untuk Kontainer Utama */
                      "surface-dim": "#0a0f1d",
                      "surface-variant": "#1e2942",  /* Steel Navy untuk Card / Komponen */
                      "on-surface": "#ffffff",
                      "on-surface-variant": "#94a3b8",/* Slate Gray untuk Sub-teks yang Lembut */
                      "outline-variant": "#2e3f5f",  /* Pembatas Muted Navy yang Elegan */
                      "surface-container-low": "#0e1626",
                      "surface-container": "#131b2e",
                      "surface-container-high": "#1a243b",
                      "surface-container-highest": "#243254",
                      "secondary-container": "#3b82f6",/* Biru Safir untuk Indikator Aktif */
                      "error": "#f87171",
              },
              "fontFamily": {
                      "body-sm": ["Geist"],
                      "headline-lg": ["Space Grotesk"],
                      "headline-lg-mobile": ["Space Grotesk"],
                    "body-md": ["Geist"],
                    "label-tech": ["JetBrains Mono"]
            }
        },
    },
}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #0e1626; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #2e3f5f; border-radius: 10px; }
        /* Efek Shadow premium, menghilangkan efek neon mencolok */
        .premium-shadow { box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.5); }
    </style>
</head>
<body class="bg-background text-on-background font-body-md overflow-hidden h-screen flex flex-col">

    @include('components.navbar')

    <div class="flex flex-1 overflow-hidden">
        @include('components.sidebar')

        <main class="flex-1 ml-64 p-8 bg-surface-dim overflow-y-auto custom-scrollbar pb-32">
            @yield('content')
        </main>
    </div>

    @include('components.footer')

</body>
</html>