@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-4 text-amber-400">Detail Pesanan</h1>

    <div class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <div class="font-semibold text-lg">{{ $order->product_name }}</div>
            <div class="text-sm text-gray-600">Jumlah: {{ $order->qty }}</div>
            <div class="text-sm text-gray-600">Total: Rp {{ number_format($order->total,0,',','.') }}</div>
            <div class="text-sm text-gray-600">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</div>
            @if($order->status === 'confirmed')
                @php $eta = $order->created_at->copy()->addDays(3); @endphp
                <div class="text-sm text-gray-600">Estimasi tiba: <strong>{{ $eta->format('d M Y') }}</strong></div>
            @endif
            @php
                switch($order->status) {
                    case 'rejected': $sclass = 'text-red-600'; break;
                    case 'confirmed': $sclass = 'text-green-600'; break;
                    case 'delivered': $sclass = 'text-green-600'; break;
                    case 'complained': $sclass = 'text-yellow-600'; break;
                    default: $sclass = 'text-gray-600'; break;
                }
            @endphp
            <div class="mt-2">Status: <strong class="{{ $sclass }}">{{ ucfirst($order->status) }}</strong></div>

            @if($order->status === 'complained')
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                    <div class="text-sm text-yellow-800 font-semibold">Keluhan terkirim</div>
                    <div class="text-sm text-yellow-700 mt-1">Tim admin sedang meninjau keluhan Anda. Silakan tunggu pemberitahuan dari admin.</div>
                </div>
            @endif
            {{-- If admin has confirmed (responded) to the complaint, show admin response + satisfaction question --}}
            @if(isset($complaint) && $complaint->status === 'confirmed')
                @php
                    $adminNote = null;
                    if(!empty($complaint->metadata) && is_array($complaint->metadata)) {
                        $adminNote = $complaint->metadata['admin_note'] ?? $complaint->metadata['note'] ?? null;
                    }
                @endphp
                <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded">
                    <div class="font-semibold text-blue-800">Admin telah menanggapi keluhan Anda</div>
                    <div class="mt-2 text-sm text-blue-700">{{ $adminNote ?? 'Admin telah menanggapi keluhan Anda.' }}</div>

                    <div class="mt-3">
                        <div class="text-sm font-medium">Apakah Anda puas?</div>
                        <form method="POST" action="{{ route('shop.complaints.satisfaction', $complaint->id) }}">
                            @csrf
                            <div class="mt-2 flex items-center space-x-2">
                                <button type="submit" name="satisfied" value="yes" class="px-4 py-2 bg-green-600 text-white rounded">Iya</button>
                                <button type="submit" name="satisfied" value="no" class="px-4 py-2 bg-gray-200 text-gray-800 rounded">Tidak</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="border-t pt-4">
            <h3 class="font-semibold mb-2">Informasi Penerima</h3>
            <p class="text-sm">Nama: {{ $order->name }}</p>
            <p class="text-sm">Alamat: {{ $order->address }}</p>
        </div>

        @if($order->status === 'rejected')
            <div class="mt-4 bg-red-50 border border-red-200 p-4 rounded">
                <div class="font-semibold text-red-700">Pesanan ditolak oleh admin</div>
                <div class="text-sm text-red-600">Alasan: {{ $order->metadata['reject_reason'] ?? 'Tidak ada alasan diberikan.' }}</div>

                {{-- If there's a related complaint rejected by admin, show admin's description visibly so user knows why --}}
                @if(isset($complaint) && $complaint->status === 'rejected')
                    @php
                        $adminNote = null;
                        if(!empty($complaint->metadata) && is_array($complaint->metadata)) {
                            $adminNote = $complaint->metadata['admin_note'] ?? $complaint->metadata['note'] ?? null;
                        }
                    @endphp

                    <div class="mt-3 bg-red-100 border border-red-200 p-3 rounded">
                        <div class="font-semibold text-red-800">Keterangan penolakan dari admin</div>
                        <div class="mt-2 text-sm text-red-700">{{ $adminNote ?? 'Admin tidak memberikan keterangan tambahan.' }}</div>
                        <div class="mt-3 flex items-center space-x-2">
                            <button id="btn-appeal" class="px-3 py-1 bg-blue-600 text-white rounded text-sm">Ajukan Banding</button>
                            <a href="{{ route('shop.orders.show', $order->id) }}#complaint-form" class="text-sm font-medium text-indigo-600 no-underline hover:no-underline">Lihat detail keluhan</a>
                        </div>
                        <script>
                            document.getElementById('btn-appeal')?.addEventListener('click', function(){
                                // reveal complaint form and prefill title
                                document.getElementById('complaint-form').style.display = 'block';
                                var complainBtn = document.getElementById('btn-complain');
                                if(complainBtn) complainBtn.style.display = 'none';
                                var titleInput = document.querySelector('#complaint-form input[name="title"]');
                                if(titleInput){ titleInput.value = 'Banding: {{ addslashes($complaint->title ?? "") }}'; }
                                setTimeout(function(){ window.scrollTo({ top: document.getElementById('complaint-form').offsetTop - 80, behavior: 'smooth' }); }, 50);
                            });
                        </script>
                    </div>
                @endif
                    @if(isset($complaint) && $complaint->status === 'closed')
                        <div class="mt-3 bg-green-100 border border-green-200 p-3 rounded">
                            <div class="font-semibold text-green-800">Keluhan Anda diterima</div>
                            <div class="mt-2 text-sm text-green-700">{{ $complaint->metadata['admin_note'] ?? $complaint->metadata['note'] ?? 'Admin telah menandai keluhan Anda sebagai diselesaikan.' }}</div>
                        </div>
                    @endif
            </div>
        @endif

        <div class="mt-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('shop.orders') }}" class="text-sm font-medium text-amber-600 no-underline hover:no-underline">&larr; Kembali ke riwayat pesanan</a>

                {{-- If admin has confirmed the order, show receive + complain --}}
                @if($order->status === 'confirmed')
                    <form method="POST" action="{{ route('shop.orders.receive', $order->id) }}" class="inline-block">
                        @csrf
                        <button type="submit" class="ml-3 px-3 py-1 bg-green-600 text-white rounded text-sm">Sudah diterima</button>
                    </form>
                    <button id="btn-complain" class="ml-2 px-3 py-1 bg-red-600 text-white rounded text-sm">Ajukan Komplain</button>

                {{-- If order was rejected, show refund acknowledgement + complain --}}
                @elseif($order->status === 'rejected')
                    <div class="w-full mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                        <div class="text-sm text-yellow-800">Admin akan segera mengembalikan duitmu, apakah sudah menerimanya?</div>
                    </div>
                    @php $refundAck = data_get($order->metadata, 'refund_acknowledged', false); @endphp
                    @if(!$refundAck)
                        <form method="POST" action="{{ route('shop.orders.refund_received', $order->id) }}" class="inline-block">
                            @csrf
                            <button type="submit" class="ml-3 px-3 py-1 bg-green-600 text-white rounded text-sm">Saya sudah menerima</button>
                        </form>
                    @else
                        <span class="ml-3 px-3 py-1 bg-green-100 text-green-800 rounded text-sm">Anda telah menerima pengembalian</span>
                    @endif
                    <button id="btn-complain" class="ml-2 px-3 py-1 bg-red-600 text-white rounded text-sm">Ajukan Komplain</button>

                @else
                    {{-- pending or other statuses: do not show action buttons --}}
                @endif
            </div>

            {{-- If order delivered, allow user to give review --}}
            @if($order->status === 'delivered')
                <div class="mt-4 p-4 bg-emerald-50 border border-emerald-100 rounded">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium">Pesanan sudah diterima — ingin beri bintang?</div>
                            <div class="text-xs text-gray-500">Anda hanya bisa memberi ulasan setelah pesanan ditandai sudah diterima.</div>
                        </div>
                        <div>
                            @php $hasReview = \App\Models\Review::where('order_id', $order->id)->where('user_id', auth()->id())->exists(); @endphp
                            @if($hasReview)
                                <span class="text-sm text-gray-600">Anda sudah memberi ulasan</span>
                            @else
                                <a href="{{ route('orders.review.create', $order->id) }}" class="px-3 py-2 bg-emerald-600 text-white rounded">Beri Ulasan</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div id="complaint-form" class="mt-4 bg-gray-50 p-4 rounded border" style="display:none;">
                <form method="POST" action="{{ route('shop.orders.complain', $order->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label class="block text-sm font-medium">Nama Keluhan</label>
                        <input name="title" required class="mt-1 block w-full rounded p-2 shadow-sm transition focus:shadow-md" />
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium">Detail Penjelasan</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded p-2 shadow-sm transition focus:shadow-md"></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-medium">Foto Bukti (opsional)</label>
                        <input type="file" name="evidence" accept="image/*" class="mt-1 block shadow-sm" />
                    </div>
                    <div class="flex items-center space-x-2 mt-2">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Kirim Komplain</button>
                        <button type="button" id="btn-cancel-complain" class="px-3 py-1 bg-gray-200 rounded">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        document.getElementById('btn-complain')?.addEventListener('click', function(){
            document.getElementById('complaint-form').style.display = 'block';
            this.style.display = 'none';
        });
        document.getElementById('btn-cancel-complain')?.addEventListener('click', function(){
            document.getElementById('complaint-form').style.display = 'none';
            document.getElementById('btn-complain').style.display = 'inline-block';
        });
    </script>
    @if(session('show_complaint_form'))
        <script>
            // If redirected after "Tidak" (not satisfied), auto-open complaint form
            document.addEventListener('DOMContentLoaded', function(){
                var form = document.getElementById('complaint-form');
                if (form) {
                    form.style.display = 'block';
                    var btn = document.getElementById('btn-complain');
                    if (btn) btn.style.display = 'none';
                    try { window.scrollTo({ top: form.offsetTop - 80, behavior: 'smooth' }); } catch(e) {}
                }
            });
        </script>
    @endif
@endsection
