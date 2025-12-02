@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="relative">
        <a href="{{ route('shop.index') }}" class="absolute top-2 left-2 inline-flex items-center p-2 bg-white text-gray-700 rounded shadow-sm hover:shadow-md no-underline">
            &larr; Back to Shop
        </a>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-start justify-between">
                <div>
                    <div class="text-sm text-gray-500">Ulasan oleh <strong>{{ $review->user->name }}</strong> pada produk <a href="{{ route('shop.show', $review->product->slug) }}" class="text-amber-600 underline">{{ $review->product->name }}</a></div>
                    <h2 class="text-2xl font-bold mt-2 text-gray-900">{{ $review->title ?? 'Ulasan' }}</h2>
                    <div class="mt-2 text-sm text-gray-600 flex items-center gap-2">
                        <span class="inline-flex text-amber-500 font-semibold">{{ $review->rating }}★</span>
                        <span class="text-xs text-gray-400">/ 5</span>
                    </div>
                </div>
                <div class="text-sm text-gray-500">{{ $review->created_at->format('d M Y H:i') }}</div>
            </div>

            <div class="mt-4 text-gray-700 leading-relaxed">{{ $review->body }}</div>
        </div>
    </div>
</div>
@endsection
