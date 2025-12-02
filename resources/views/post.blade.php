<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Article</title>
@php
	$isProduction = app()->environment('production');
	$manifestPath = $isProduction ? '../public_html/build/manifest.json' : public_path('build/manifest.json');
@endphp
        @if ($isProduction && file_exists($manifestPath))
    @php
	    $manifest = json_decode(file_get_contents($manifestPath), true)
	@endphp
	   <link rel="stylesheet" href="{{ config('app.url') }}/build/{{ $manifest['resources/css/app.css']['file'] }}">
	   <script type="module" src="{{ config('app.url') }}/build/{{ $manifest['resources/js/app.js']['file'] }}"></script>
@else
	   @viteReactRefresh
	   @vite(['resources/js/app.js', 'resources/css/app.css'])
@endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-gray-50">
    <x-navbar></x-navbar>
    <div class=" py-16 mt-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
                
                <main class="lg:col-span-8">
                    
                    <div class="mb-8 border-b border-gray-100 pb-6">
                        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-semibold tracking-wide uppercase bg-amber-400 text-gray-900">
                            Daur Ulang
                        </span>
                        
                        <h1 class="mt-4 text-4xl font-extrabold text-gray-900 sm:text-5xl leading-tight">
                            {{ $post['title'] }}
                        </h1>
                        
                        <div class="mt-4 flex items-center text-gray-500 text-sm">
                            <div class="leading-relaxed">
                                <span class="font-medium text-gray-800 block">{{ $post['author'] }}</span>
                                <time class="text-xs text-gray-500">
                                    @if(!empty($post['created_at']))
                                        {{ \Illuminate\Support\Carbon::parse($post['created_at'])->format('j M Y, H:i') }}
                                    @else
                                        Tanggal tidak tersedia
                                    @endif
                                </time>
                            </div>
                            <div class="ml-4 text-xs text-gray-400">• • •</div>
                        </div>
                    </div>

                    <div class="mb-10">
                        @if (isset($post['image_url']))
                        <div class="mt-6 mb-8">
                        <img src="{{ asset('image/' . $post['image_url']) }}" 
                            alt="{{ $post['title'] }}" 
                            class="w-full h-96 object-cover rounded-lg shadow-md" />
                        </div>
                        @endif  
                        <p class="mt-3 text-sm text-gray-500 italic text-center">
                            Fasilitas pirolisis dapat mengubah plastik menjadi bahan bakar cair.
                        </p>
                    </div>

                    <article class="prose prose-lg max-w-none text-gray-800">
                        {{-- Render body with line breaks preserved and proper paragraphs --}}
                        {!! nl2br(e($post['body'])) !!}
                    </article>

                    <div class="mt-12 pt-6 border-t border-gray-200 flex justify-between items-center flex-wrap">
                        <div class="flex flex-wrap gap-2">
                            <span class="font-semibold text-gray-700 mr-1">Tags:</span>
                            <a href="#" class="inline-flex items-center px-3 py-1 text-sm font-medium bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition">{{ $post['tag1'] }}</a>
                            <a href="#" class="inline-flex items-center px-3 py-1 text-sm font-medium bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition">{{ $post['tag2'] }}</a>
                        </div>

                        {{-- Tombol Share Sosial Media (Menggunakan placeholder) --}}
                        <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                            <span class="text-gray-700 font-semibold">Bagikan:</span>
                            <a href="#" class="text-gray-400 hover:text-blue-600 transition" aria-label="Share to Twitter">
<i class="fa-brands fa-twitter"></i>                            </a>
                            <a href="#" class="text-gray-400 hover:text-green-600 transition" aria-label="Share to WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i></a>
                        </div>
                    </div>

                </main>

                <aside class="mt-12 lg:mt-0 lg:col-span-4 space-y-10">
                    
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-bold text-gray-900 border-b border-amber-400 pb-3 mb-4">Paling Populer</h3>
                        <ul class="space-y-4">
                            @forelse($posts as $post)
                                <li>
                                    <a href="{{ route('posts.show', $post['slug']) }}" class="group block">
                                        <p class="text-xs font-medium text-amber-600">{{ $post['label'] }}</p>
                                        <h4 class="text-lg font-semibold text-gray-800 group-hover:text-amber-600 transition duration-300 line-clamp-2">
                                            {{ $post['title'] }}
                                        </h4>
                                        <p class="text-sm text-gray-500 mt-1">
                                            @if(!empty($post['created_at']))
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post['created_at'])->format('j M Y') }}
                                            @else
                                                Tanpa tanggal
                                            @endif
                                        </p>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <p class="text-sm text-gray-500">Tidak ada artikel tersedia</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    
                    
                </aside>
                
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>