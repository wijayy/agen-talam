<x-layouts.admin title="Semua Transaksi">
    <div class="p-4">
        <div class="font-semibold flex gap-4 items-center text-lg">Semua Transaksi pada <form action="" method="get">
                <flux:input wire:model="date" value="{{ request('date', date('Y-m-d')) }}" onchange="this.form.submit()" type="date" />
            </form>
        </div>
        <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 gap-4 ">
            @foreach ($transaksi as $item)
            <div class="shadow-lg rounded-lg h-fit p-4 bg-white dark:bg-neutral-700">
                <div class="flex justify-between">
                    <div class="">
                        <div class="font-semibold text-sm lg:text-lg">{{ $item->nomor_transaksi }}</div>
                        <div class="text-xs lg:text-sm">{{ $item->name ?? $item->user->name }} </div>
                        <div class="text-xs lg:text-sm">{{ $item->email ?? $item->user->email }} </div>
                        <flux:link variant="ghost" class="text-xs lg:text-sm" external href="https://wa.me/{{ $item->whatsapp }}" class="">{{ $item->whatsapp }}</flux:link>
                        <div class="text-xs lg:text-sm">Tanggal Keberangkatan : {{ $item->date->format('Y/m/d') }}
                        </div>
                        <div class="text-xs lg:text-sm">{{ $item->pax }} pax </div>
                        @if ($item->address??false)
                        <div class="text-xs lg:text-sm">Penjemputan: {{ $item->address }} </div>
                        @endif
                    </div>
                    <div class="lg:text-lg text-nowrap {{ $item->status_pembayaran ? 'text-mine-400' : 'text-rose-400' }}">
                            <div class="">{{ $item->status_pembayaran ? "Lunas" : "Belum Bayar" }} </div>
                        <div class="">IDR {{ number_format($item->total,0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @empty($transaksi)
        <div class="h-96 w-full flex text-zinc-400 justify-center items-center">
            Anda tidak memiliki transaksi
        </div>
        @endempty
    </div>
</x-layouts.admin>
