@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Beri Ulasan untuk {{ $product->name }}</h1>

    <div class="bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('orders.review.store', $order->id) }}">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium">Rating</label>
                <select name="rating" class="mt-1 block w-24 rounded border px-2 py-1">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Judul (opsional)</label>
                <input name="title" class="mt-1 block w-full rounded border px-3 py-2" />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Ulasan</label>
                <textarea name="body" rows="6" class="mt-1 block w-full rounded border px-3 py-2"></textarea>
            </div>
            <div class="flex items-center space-x-2">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Kirim Ulasan</button>
                <a href="{{ route('shop.orders.show', $order->id) }}" class="text-sm text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
