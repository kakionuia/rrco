<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
        /* Loading screen styles */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #1B5E20 0%, #2E7D32 50%, #FCD34D 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            animation: fadeInUp 0.8s ease-out;
        }

        .loading-logo-container {
            position: relative;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading-logo {
            width: 200px;
            height: 100px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.2));
        }

        .loading-spinner-ring {
            position: absolute;
            width: 130px;
            height: 130px;
            border: 3px solid rgba(252, 211, 77, 0.2);
            border-top: 3px solid #FCD34D;
            border-radius: 50%;
            animation: spin 2.5s linear infinite;
        }

        .loading-spinner-ring::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border: 2px solid rgba(27, 94, 32, 0.15);
            border-top: 2px solid #1B5E20;
            border-radius: 50%;
            top: 13px;
            left: 13px;
            animation: spinReverse 1.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @keyframes spinReverse {
            to { transform: rotate(-360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading-text {
            color: white;
            font-size: 22px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            animation: pulse 2s ease-in-out infinite;
        }

        .loading-dots {
            display: inline-block;
            width: 6px;
        }

        .loading-dots::after {
            content: '.';
            animation: dots 1.5s steps(4, end) infinite;
        }

        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .swiper {
            width: 80%; /* Lebar karusel */
            height: 300px; /* Tinggi karusel */
            margin: 50px auto;
            border-radius: 10px; /* Sedikit lengkungan pada sudut karusel */
            overflow: hidden; /* Penting untuk border-radius */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .swiper-slide {
            text-align: center;
            font-size: 24px; /* Sedikit lebih besar untuk keterbacaan */

            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff; /* Warna teks di slide: Putih */
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3); /* Bayangan teks agar lebih menonjol */
        }

        .slide-1 {
            background-image: url('/image/landing.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }        .slide-2 { background-color: #66BB6A; } /* Hijau lebih muda */
        .slide-3 { background-color: #81C784; } /* Hijau lebih muda lagi */

        .swiper-pagination-bullet {
            background-color: #81C784; /* Warna titik non-aktif */
            opacity: 0.7;
        }

        .swiper-pagination-bullet-active {
            background-color: #4CAF50; /* Warna titik aktif */
            opacity: 1;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #4CAF50; /* Warna panah */
            --swiper-navigation-size: 30px; 
        }
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            color: #388E3C; 
        }
        /* Make UI cleaner: remove visible borders used by Tailwind utilities to achieve a more professional, card-like look */
        .border, .border-t, .border-b, .border-l, .border-r,
        .border-gray-50, .border-gray-100, .border-gray-200, .border-gray-300, .border-gray-400, .border-gray-700,
        .border-red-200, .border-yellow-200, .border-amber-100, .border-emerald-100 {
            border: none !important;
        }
        /* Remove small card outlines/shadows where border classes were used */
        .ring-1, .ring-2 { box-shadow: none !important; }
        /* Buttons and inputs keep their outlines for accessibility; only remove layout borders */
        </style>
    </head>
    <body class="bg-gradient-to-br from-green-700 to-green-900 bg-no-repeat w-full min-h-screen">
        <!-- Loading Overlay -->
        <div id="loading-overlay">
            <div class="loading-container">
                <div class="loading-logo-container">
                    <div class="loading-spinner-ring"></div>
                    <img src="{{ asset('image/logo-2.png') }}" alt="RRCO Logo" class="loading-logo">
                </div>
                <div class="loading-text">
                    Memuat<span class="loading-dots"></span>
                </div>
            </div>
        </div>

        {{-- Flash notifications (success / error / info) --}}
        @if(session('success') || session('error') || session('info'))
            <div aria-live="polite" class="fixed top-5 right-5 z-50 space-y-2">
                @if(session('success'))
                    <div id="flash-success" class="px-4 py-2 bg-green-600 text-white rounded shadow">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div id="flash-error" class="px-4 py-2 bg-red-600 text-white rounded shadow">{{ session('error') }}</div>
                @endif
                @if(session('info'))
                    <div id="flash-info" class="px-4 py-2 bg-blue-600 text-white rounded shadow">{{ session('info') }}</div>
                @endif
            </div>

            <script>
                // auto-dismiss after 5s
                setTimeout(() => {
                    const s = document.getElementById('flash-success');
                    const e = document.getElementById('flash-error');
                    const i = document.getElementById('flash-info');
                    [s,e,i].forEach(el => { if(el) el.style.display = 'none'; });
                }, 5000);
            </script>
        @endif
            <main>
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>

        <script>
        // Loading overlay handler
        window.addEventListener('load', function() {
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                setTimeout(() => {
                    loadingOverlay.classList.add('hidden');
                }, 800);
            }
        });

        // Hide loading overlay if page is cached (instant load)
        if (document.readyState === 'complete') {
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.classList.add('hidden');
            }
        }
        </script>
    </body>
</html>
