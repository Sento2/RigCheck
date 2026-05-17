<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>RigCheck | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=JetBrains+Mono:wght@100..800&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ffffff",
                        "background": "#0a0f1d",
                        "surface": "#131b2e",
                        "surface-variant": "#1e2942",
                        "surface-container-lowest": "#070b14",
                        "outline-variant": "#2e3f5f",
                        "on-surface": "#ffffff",
                        "on-surface-variant": "#94a3b8",
                        "on-primary": "#0a0f1d",
                        "secondary": "#3b82f6",
                        "secondary-fixed": "#60a5fa",
                    },
                    fontFamily: {
                        "body-md": ["Geist"],
                        "label-tech": ["JetBrains Mono"],
                        "headline-lg": ["Space Grotesk"],
                        "body-sm": ["Geist"]
                    }
                }
            }
        }
    </script>
    <style>
        /* Pola grid teknologi diubah menjadi sangat tipis dan pudar */
        .tech-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.02) 1px, transparent 0);
            background-size: 24px 24px;
        }
        /* Orb diganti dari hijau terang ke Biru Navy redup */
        .glow-orb {
            filter: blur(100px);
            opacity: 0.2;
            background: radial-gradient(circle, #1e3a8a 0%, transparent 70%);
        }
        .glass-card {
            background: rgba(19, 27, 46, 0.7);
            backdrop-filter: blur(20px);
        }
        /* Fokus input menggunakan border putih bersih */
        .clean-focus:focus-within {
            border-color: #ffffff;
            box-shadow: 0 0 0 1px #ffffff;
        }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex items-center justify-center overflow-hidden font-body-md selection:bg-primary selection:text-on-primary">
    
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="tech-pattern absolute inset-0"></div>
        <div class="glow-orb absolute -top-40 -left-40 w-[600px] h-[600px] rounded-full"></div>
        <div class="glow-orb absolute -bottom-40 -right-40 w-[600px] h-[600px] rounded-full"></div>
    </div>

    <main class="relative z-10 w-full max-w-[480px] px-4 md:px-0">
        
        @yield('content')

        <div class="mt-8 flex items-center justify-center space-x-6 opacity-40">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                <span class="font-label-tech text-[10px] uppercase tracking-tighter">Auth Cluster Online</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="font-label-tech text-[10px] uppercase tracking-tighter">Lat: 22ms</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="font-label-tech text-[10px] uppercase tracking-tighter">v2.4.0-STABLE</span>
            </div>
        </div>
    </main>
</body>
</html>