<x-layouts.app title="History Transaksi">
    <div class=" w-full h-full">
        <flux:container class="pt-20 pb-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 ">
                {{-- @dd($transaksi) --}}
                @foreach ($transaksi as $item)
                <div class="shadow-lg rounded-lg h-fit p-4 bg-white dark:bg-neutral-700">
                    <div class="border-b border-black  flex justify-between pb-4">
                        <div class="">
                            <div class="font-semibold text-sm lg:text-lg">{{ $item->nomor_transaksi }}</div>
                            <div class="text-xs lg:text-sm">{{ $item->name ?? $item->user->name }} </div>
                            <div class="text-xs lg:text-sm">{{ $item->email ?? $item->user->email }} </div>
                            @if (Auth::user()->is_admin)
                            <flux:link variant="subtle" class="text-xs lg:text-sm" external
                                href="https://wa.me/{{ $item->whatsapp }}" class="">{{ $item->whatsapp }}</flux:link>
                            @endif
                            <div class="text-xs lg:text-sm capitalize {{ $item->status_pembayaran == " sudah dibayar"
                                ? "text-mine-400" : "text-rose-500" }} ">Status :  {{ $item->status_pembayaran }} </div>
                            <div class=" text-xs lg:text-sm">Tanggal Keberangkatan : {{ $item->date->format('Y/m/d') }}
                            </div>
                            <div class="text-xs lg:text-sm">{{ $item->pax }} pax </div>
                            @if ($item->address??false)
                            <div class="text-xs lg:text-sm">Penjemputan: {{ $item->address }} </div>
                            @endif
                        </div>
                        <div class="lg:text-lg">IDR {{ number_format($item->total,0, ',', '.') }}</div>
                    </div>
                    @if ($item->status_pembayaran == 'belum bayar')
                    <div class="flex justify-end mt-4 gap-4">
                        <form action="{{ route('checkout.destroy', ['checkout'=>$item->slug]) }}" method="post">
                            @csrf
                            @method('delete')
                            <flux:action-a class="bg-rose-400" as>Batalkan</flux:action-a>
                        </form>
                        <flux:action-a class="bg-mine-400"
                            href="{{ route('checkout.show', ['checkout' => $item->slug]) }}">Bayar
                        </flux:action-a>
                    </div>
                    @elseif ($item->status_pembayaran == 'sudah dibayar')
                    @if ($item->date->greaterThan($today) || $now->lessThan($today->copy()->addHours(12)))
                    <div class=" text-sm  lg:text-base text-red-700 py-2">{{ $item->address ??
                        false ? "Pastikan Anda
                        siap sudah siap di lokasi penjemputan sebelum jam 7.30AM" : "Pastikan Anda sudah tiba di markas
                        keberangkatan sebelum 7.30AM" }} </div>
                    @else
                    @if ($item->review)
                    <div class="flex mt-4 gap-0.5 items-center">
                        <div class="sr-only">rating</div>
                        @for ($i = 0; $i < floor($item->review->rate); $i++)
                            {{-- <i class="bx bxs-star text-yellow-500"></i> --}}
                            <flux:icon.star :variant="'micro'"
                                class="stroke-mine-400 dark:stroke-mine-400 fill-mine-400">
                            </flux:icon.star>
                            @endfor
                            @for ($i = 5; $i > ceil($item->review->rate); $i--)
                            <flux:icon.star :variant="'micro'" class="stroke-gray-500"></flux:icon.star>
                            @endfor
                    </div>
                    <div class="mt-2">{{ $item->review->review }} </div>
                    @else
                    <div class="py-2">Ceritakan kesan perjalanan anda</div>
                    <form x-data="{ rating: 0 }" action="{{ route('history.update', ['history'=>$item->id]) }}" class=""
                        method="post">
                        @csrf
                        @method('put')
                        <div class="flex space-x-2">
                            <template x-for="star in 5" :key="star">
                                <flux:icon.star @click="rating = star" :variant="'micro'" ::class="{
                                    'stroke-mine-400 fill-mine-400': rating >= star,
                                    'stroke-gray-400': rating < star
                                }">
                                </flux:icon.star>
                            </template>
                            <input type="hidden" name="rate" min="1" :value="rating">
                        </div>
                        <flux:input wire:model="review" class="" :label="__('Review')" type="text" required
                            autocomplete="off" />

                        <flux:action-a ::disabled="rating < 1" class="bg-mine-400 mt-2" as>Submit</flux:action-a>
                    </form>
                    @endif
                    @endif
                    @endif
                </div>

                @endforeach
            </div>
            @if($transaksi->isEmpty())
            <div class="h-96 w-full flex text-zinc-400 justify-center items-center">
                Anda tidak memiliki transaksi
            </div>
            @endif
            <div class="mt-4">
                {{ $transaksi->links() }}
            </div>
        </flux:container>
        <x-layouts.app.footer class="app  footer">
        </x-layouts.app.footer>
    </div>
</x-layouts.app>
