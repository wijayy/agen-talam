<x-layouts.auth.card class="auth card text-black dark:text-white">
    <div class="text-center text-black dark:text-white font-semibold">Checkout</div>
    <div class="text-black dark:text-white">
        <div class="text-sm font-semibold">Customer Info</div>
        <div class="flex">
            <div class="w-1/2">Nomor Transaksi </div>
            <div class="w-1/2">: {{ $transaksi->nomor_transaksi }} </div>
        </div>
        <div class="flex">
            <div class="w-1/2">Nama </div>
            <div class="w-1/2">: {{ $transaksi->name ?? $transaksi->user->name }} </div>
        </div>
        <div class="flex">
            <div class="w-1/2">Email </div>
            <div class="w-1/2">: {{ $transaksi->email ?? $transaksi->user->email }} </div>
        </div>
        <div class="flex">
            <div class="w-1/2">Whatsapp </div>
            <div class="w-1/2">: {{ $transaksi->whatsapp }} </div>
        </div>
        @if ($transaksi->address??false)
        <div class="flex">
            <div class="w-1/2">Alamat Penjemputan </div>
            <div class="w-1/2">: {{ $transaksi->address }} </div>
        </div>
        @endif
    </div>
    <div class="mt-4 text-black dark:text-white">
        <div class="text-sm font-semibold">Checkout Info</div>
        <div class="">Tiket ke Manjangan tanggal {{ $transaksi->date->format("d F Y") }} x{{ $transaksi->pax }} </div>
        <div class="flex">
            <div class="w-1/2">Total </div>
            <div class="w-1/2">: IDR {{ number_format($transaksi->total,0, ',', '.') }} </div>
        </div>
    </div>

    <div class="flex justify-center">
        <flux:action-a id="pay-button" class="bg-neutral-300 mt-4 text-black dark:text-white dark:bg-neutral-700 hover:bg-mine-400">Bayar
        </flux:action-a>
    </div>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>


    <script type="text/javascript">
        let route = "{{ route('checkout.update', ['checkout' => $transaksi->slug]) }}";
        console.log(route);
        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                // Kirim data ke route update via POST

                console.log(result);

                fetch("{{ url('/api/midtrans/callback') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result)
                })
                .then(data => {
                    window.location.href = "{{ route('history.index') }}";
                });
            },
                onPending: function(result){
                    console.log("Pembayaran Pending");
                },
                onError: function(result){
                    alert("Pembayaran gagal, silakan coba lagi.");
                },
                onClose: function(){
                    alert("Kamu menutup pembayaran sebelum selesai.");
                }
            });
        });
    </script>


</x-layouts.auth.card>
