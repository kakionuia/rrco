<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tazaj Mart - UI dengan Tailwind CSS</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        input[type="search"]::-webkit-search-decoration,
        input[type="search"]::-webkit-search-cancel-button,
        input[type="search"]::-webkit-search-results-button,
        input[type="search"]::-webkit-search-results-decoration {
            display: none;
        }
        input[type="search"] {
            -ms-clear: none;
        }
        .product-card-img {
            height: 120px; 
            object-fit: contain; 
        }
        .rating-stars {
            color: #ffc107; /* Warna bintang kuning */
        }
        .rating-stars .far { /* Untuk bintang kosong */
            color: #ddd;
        }

    .swiper-button-next, .swiper-button-prev {
        color: white; /* Mengubah warna panah */
        background-color: rgba(0, 0, 0, 0.4); /* Background semi-transparan */
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transition: background-color 0.3s;
        transform: scale(0.8);
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }
    .swiper-button-next::after, .swiper-button-prev::after {
        font-size: 18px;
        font-weight: bold;
    }
    .swiper-pagination-bullet {
        background: #fff; /* Warna default titik */
        opacity: 0.5;
    }
    .swiper-pagination-bullet-active {
        background: #fff; /* Warna titik yang aktif */
        opacity: 1;
    }
    /* Additional styling for nicer slides */
    .bootstrapCarousel .swiper-slide > div {
        min-height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bootstrapCarousel .swiper-slide .bg-black\/50 {
        background: rgba(0,0,0,0.45) !important;
    }
    .bootstrapCarousel .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
    }
    .bootstrapCarousel .swiper-button-next,
    .bootstrapCarousel .swiper-button-prev{
        display:flex; align-items:center; justify-content:center;
    }
    </style>
</head>
<body class="bg-white">
<x-navbar></x-navbar>
<section class="">
    <div class="mx-auto w-full relative"> 
        <div class="swiper bootstrapCarousel h-64 md:h-96 lg:h-[480px] shadow-xl overflow-hidden">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide">
                    <div class="w-full h-full bg-cover bg-center flex items-center justify-center p-8 text-white" 
                         style="background-image: url({{ asset('image/tas.jpg') }});">
                        <div class="bg-black/50 p-4 rounded-lg text-center max-w-md">
                            <h3 class="text-3xl font-bold">Slide Pertama</h3>
                            <p class="mt-2 text-lg">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="w-full h-full bg-cover bg-center flex items-center justify-center p-8 text-white" 
                         style="background-image: url('https://images.unsplash.com/photo-1557804506-669145281898?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        <div class="bg-black/50 p-4 rounded-lg text-center max-w-md">
                            <h3 class="text-3xl font-bold">Slide Kedua</h3>
                            <p class="mt-2 text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="w-full h-full bg-cover bg-center flex items-center justify-center p-8 text-white" 
                         style="background-image: url('https://images.unsplash.com/photo-1518175517855-32130e6118b7?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
                        <div class="bg-black/50 p-4 rounded-lg text-center max-w-md">
                            <h3 class="text-3xl font-bold">Slide Ketiga</h3>
                            <p class="mt-2 text-lg">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

            <button class="swiper-button-next" aria-label="Next slide"></button>
            <button class="swiper-button-prev" aria-label="Previous slide"></button>
        </div>
    </div>
</section>
    <main class="container mt-20 mx-auto px-4 md:px-8 lg:px-12">
        <section class="bg-green-600 rounded-lg p-6 flex flex-col md:flex-row items-center justify-between text-white mb-8">
            <div class="md:w-1/2 text-center md:text-left mb-4 md:mb-0">
                <h2 class="text-3xl md:text-4xl font-bold mb-2">Get free delivery on shopping $200</h2>
                <p class="text-lg mb-4">The best groceries delivered right to your home, free with eligble orders.</p>
                <a href="#" class="bg-white text-green-600 px-6 py-3 rounded-md font-semibold hover:bg-gray-100 transition duration-300">Shop Now</a>
            </div>
            <div class="md:w-1/2 flex justify-center md:justify-end">
                <img src="{{ asset('image/') }}" alt="">
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">All Products</h2>
            {{-- Voucher claim section: show if there's a voucher for user's tier and stock available --}}
            @if(isset($tierVoucher) && $tierVoucher)
                <div class="mb-6 bg-emerald-50 border border-emerald-100 rounded-lg p-4 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-emerald-800 font-semibold">Voucher untuk level Anda: {{ ucfirst($tierVoucher->tier) }}</div>
                        <div class="text-xs text-gray-600">Kode: <span class="font-mono">{{ $tierVoucher->code }}</span> — Diskon: @if($tierVoucher->discount_type === 'percent') {{ $tierVoucher->discount_value }}% @else Rp {{ number_format($tierVoucher->discount_value,0,',','.') }} @endif</div>
                        <div class="text-xs text-gray-500 mt-1">Sisa kuota: {{ $tierVoucher->stock }}</div>
                    </div>
                    <div class="">
                        @auth
                            @if($userClaimed)
                                <div class="text-sm text-gray-700">Anda sudah mengklaim voucher ini.</div>
                            @else
                                <form action="{{ route('voucher.claim', $tierVoucher->id) }}" method="POST">
                                    @csrf
                                    <button class="px-4 py-2 bg-emerald-600 text-white rounded">Klaim Voucher</button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Masuk untuk klaim</a>
                        @endauth
                    </div>
                </div>
            @endif

            <div class="hidden md:flex justify-between items-center bg-white p-4 rounded-lg shadow-sm mb-6">
                <div class="flex space-x-4">
                    <form method="GET" action="{{ route('shop.index') }}" class="flex items-center space-x-2">
                        <input name="q" value="{{ $q ?? '' }}" placeholder="Search products..." class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                        <button class="px-3 py-1 bg-emerald-600 text-white rounded-md text-sm">Cari</button>
                    </form>
                    <div>
                        <select onchange="location = this.value" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none">
                            <option value="{{ route('shop.index') }}" {{ empty($category) ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="{{ route('shop.index', ['category' => 'organik']) }}" {{ (isset($category) && $category == 'organik') ? 'selected' : '' }}>Organik</option>
                            <option value="{{ route('shop.index', ['category' => 'elektronik']) }}" {{ (isset($category) && $category == 'elektronik') ? 'selected' : '' }}>Elektronik</option>
                            <option value="{{ route('shop.index', ['category' => 'anorganik']) }}" {{ (isset($category) && $category == 'anorganik') ? 'selected' : '' }}>Anorganik</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('shop.orders') }}" class="ml-2 inline-flex items-center px-3 py-1 bg-white text-green-700 border border-green-200 rounded-md text-sm hover:bg-green-50">Riwayat</a>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <label for="sort" class="text-sm text-gray-600">Sort by:</label>
                    <select id="sort" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                        <option>Popularity</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-sm p-4 text-center relative hover:shadow-md transition duration-200 clickable-card" data-href="{{ route('shop.show', $product->slug) }}" style="cursor:pointer;">
                        @php $available = ($product->stock ?? 0) > 0 && ($product->is_active ?? true); @endphp
                        @if($available)
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">Tersedia</span>
                        @else
                            <span class="absolute top-2 left-2 bg-gray-400 text-white text-xs px-2 py-1 rounded-full">Stok Habis</span>
                        @endif
                        <a href="{{ route('shop.show', $product->slug) }}">
                            @php
                                // Determine image URL: admin stores '/storage/...' in DB, so if image already contains '/storage' use it directly.
                                $img = '/image/tutup.jpg';
                                if (!empty($product->image)) {
                                    $pimg = (string) $product->image;
                                    if (str_starts_with($pimg, '/storage') || str_starts_with($pimg, 'storage') || str_starts_with($pimg, '/image')) {
                                        $img = $pimg;
                                    } else {
                                        $img = Storage::url(ltrim($pimg, '/'));
                                    }
                                }
                            @endphp
                            <img src="{{ $img }}" alt="{{ $product->name }}" class="mx-auto mb-2 product-card-img">
                            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1">{{ $product->name }}</h3>
                        </a>
                        <p class="text-xs text-gray-500 mb-2">{{ $product->category?->name ?? '' }}</p>
                        <div class="flex items-center justify-center text-xs text-gray-600 mb-2">
                            <div class="rating-stars">
                                @php
                                    try { $avg = (float) $product->reviews()->avg('rating'); } catch (\Exception $e) { $avg = null; }
                                @endphp
                                @if($avg)
                                    @php $full = floor($avg); $half = ($avg - $full) >= 0.5; @endphp
                                    @for($i=1;$i<=5;$i++)
                                        @if($i <= $full)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                @else
                                    <i class="fas fa-star"></i> <span class="text-xs ml-1">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-lg font-bold text-gray-900">{{ number_format($product->price,2) }}</p>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('shop.buy', $product->slug) }}" class="buy-btn bg-green-500 text-white rounded-full h-8 w-8 flex items-center justify-center hover:bg-green-600 transition duration-200" aria-label="Beli {{ $product->name }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                                @auth
                                    @if(auth()->user()->is_admin ?? false)
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-xs text-gray-600 hover:underline">Edit</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-center">
                {{ $products->links() }}
            </div>
        </section>
    </main>

    <x-footer></x-footer>

</body>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
    // Make product cards clickable except when clicking on an anchor inside the card (e.g. buy button)
    document.addEventListener('click', function(e){
        var card = e.target.closest('.clickable-card');
        if (!card) return;
        // if click happened on an anchor inside the card, allow default anchor behavior
        if (e.target.closest('a')) return;
        var href = card.getAttribute('data-href');
        if (href) {
            window.location.href = href;
        }
    });

    document.addEventListener('DOMContentLoaded', function(){
        const carousel = new Swiper('.bootstrapCarousel', {
            direction: 'horizontal',
            loop: true,
            slidesPerView: 1,
            spaceBetween: 0,
            effect: 'slide',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                type: 'bullets',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            a11y: {
                enabled: true,
            },
        });
    });
</script>
</html>