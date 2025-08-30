@php
use App\Models\Setting;
@endphp

<x-layouts.app :title="__('Home')">
    <div class="w-full h-screen bg-cover bg-center bg-no-repeat bg-[url({{ asset('assets/hero.jpg') }})]"
        style="background-image: url({{ asset('assets/hero.jpg') }})">
        <flux:container class="flex h-full justify-end">
            <div class="w-1/2 backdrop-blur-xs flex flex-col justify-center gap-2 md:gap-4  h-full">
                <div class="text-xl md:text-4xl font-semibold md:leading-loose" style="text-shadow:
      -0.5px -0.5px 0 white,
       0.5px -0.5px 0 white,
      -0.5px  0.5px 0 white,
       0.5px  0.5px 0 white;">Jelajahi Keindahan Pulau Menjangan Bersama Agen Talam</div>
                <div class="text-sm md:text-lg">Snorkeling, diving, dan petualangan seru menantimu!</div>
            </div>
        </flux:container>
    </div>
    <flux:container>
        <div class="text-center mt-[100px] text-2xl font-semibold">Kenal Pulau Menjangan Lebih Dekat </div>

        <div class="mt-4 flex flex-col-reverse md:flex-row justify-between items-center gap-4">
            <div class=" w-full md:w-2/3 text-sm md:text-lg leading-7 md:leading-10">Pulau Menjangan merupakan permata
                tersembunyi yang
                terletak di ujung barat laut Pulau Bali. Pulau ini menjadi bagian dari kawasan konservasi Taman Nasional
                Bali Barat, menjadikannya tempat yang masih sangat alami dan jauh dari hiruk-pikuk destinasi wisata
                mainstream di Bali. Keindahan alamnya begitu memukau, terutama dengan kejernihan air lautnya yang luar
                biasa serta terumbu karang yang masih terjaga keasliannya. Tak heran jika Pulau Menjangan menjadi
                destinasi favorit bagi para pecinta snorkeling dan diving. Di sini, pengunjung akan disuguhkan
                pengalaman bawah laut yang menakjubkan—mulai dari ragam biota laut berwarna-warni, karang-karang cantik,
                hingga suasana tenang yang menenangkan jiwa. Pulau Menjangan bukan sekadar tempat wisata, tapi juga oase
                eksotis bagi siapa pun yang ingin menyatu dengan keindahan laut dan keheningan alam.</div>
            <div class="md:w-1/3 w-full rounded-lg aspect-square bg-cover bg-no-repeat bg-center"
                style="background-image: url({{ asset('assets/manjangan.png') }})">
            </div>
        </div>
        <div class="mt-4 flex justify-between flex-col md:flex-row items-center gap-4">
            <div class="md:w-1/3 w-full rounded-lg aspect-square bg-cover bg-no-repeat bg-center"
                style="background-image: url({{ asset('assets/wall.jpeg') }})">
            </div>
            <div class="md:w-2/3 w-full text-sm md:text-lg leading-7 md:leading-10">Salah satu daya tarik utama Pulau
                Menjangan adalah tebing
                bawah lautnya yang menakjubkan, yang dikenal luas dengan sebutan "Menjangan Wall". Formasi dinding
                karang yang curam dan dramatis ini menyuguhkan panorama bawah laut yang spektakuler dan menjadi surga
                bagi para penyelam. Dengan tingkat visibilitas air yang luar biasa jernih, Anda dapat dengan mudah
                mengagumi keindahan dunia bawah laut—mulai dari karang-karang berwarna-warni hingga ikan-ikan tropis
                yang berenang bebas. Tak hanya keindahan lautnya, pulau ini juga memiliki daya tarik unik di darat:
                kawanan rusa liar yang hidup bebas dan menjadi simbol ikonik dari Pulau Menjangan. Rusa-rusa ini sering
                terlihat berkeliaran di sekitar pantai, menambah pesona alami dan eksotis dari pulau kecil nan menawan
                ini.!</div>
        </div>
    </flux:container>
    <flux:container>
        <div class="text-center mt-[100px] text-2xl font-semibold">Aktifitas Seru di Pulau Menjangan
        </div>
        <div class="grid grid-cols-2 mt-4 gap-4 md:grid-cols-4">
            <div class="flex flex-col even:flex-col-reverse">
                <div class="w-full aspect-3/4 bg-cover bg-center rounded-lg bg-no-repeat"
                    style="background-image: url({{ asset('assets/snorkeling.jpg') }})"></div>
                <div class="text-center text-sm md:text-lg font-semibold py-2">Snorkeling</div>
            </div>
            <div class="flex flex-col even:flex-col-reverse">
                <div class="w-full aspect-3/4 bg-cover bg-center rounded-lg bg-no-repeat"
                    style="background-image: url({{ asset('assets/diving.jpg') }})"></div>
                <div class="text-center text-sm md:text-lg font-semibold py-2">Diving</div>
            </div>
            <div class="flex flex-col even:flex-col-reverse">
                <div class="w-full aspect-3/4 bg-cover bg-center rounded-lg bg-no-repeat"
                    style="background-image: url({{ asset('assets/trekking.jpg') }})"></div>
                <div class="text-center text-sm md:text-lg font-semibold py-2">Trekking</div>
            </div>
            <div class="flex flex-col even:flex-col-reverse">
                <div class="w-full aspect-3/4 bg-cover bg-center rounded-lg bg-no-repeat"
                    style="background-image: url({{ asset('assets/fotografi.jpg') }})"></div>
                <div class="text-center text-sm md:text-lg font-semibold py-2">Fotografi</div>
            </div>
        </div>
    </flux:container>

    <flux:container
        class="bg-white dark:bg-neutral-700 text-neutral-800 dark:text-white py-12 px-6 text-left rounded-lg shadow-md mt-[100px] border border-blue-100"
        x-data="{ showModal: false }">
        <h2 class="text-2xl font-bold text-mine-400/80 mb-4">Nikmati Liburan Lengkap ke Pulau Menjangan Bersama <span
                class="text-mine-400">Agen Talam</span>!</h2>

        <ul class="list-disc list-inside text-inherit text-lg mb-4 space-y-2">
            <li><strong>IDR {{ number_format(Setting::where('key', 'harga')->value('value'),0, ',', '.') }} per orang</strong> — sudah termasuk
                transport, makan siang, dan tiket masuk</li>
            <li><strong>Gratis penjemputan</strong> untuk area Singaraja</li>
            <li>Untuk peserta di luar Singaraja, wajib datang ke markas keberangkatan di <span
                    class="capitalize">{{config('Tiket.markas')}}</span> </li>
            <li><strong>Penjemputan hotel/villa:</strong> pukul 07.30 - 08.00 WITA</li>
        </ul>

        <div class="bg-mine-400/10 p-4 rounded-md text-inherit mb-4">
            <h3 class="font-semibold text-mine-400 mb-2">Estimasi Perjalanan:</h3>
            <ul class="list-disc list-inside space-y-1">
                <li>Singaraja/Lovina → Pelabuhan: ± 1 jam 20 menit</li>
                <li>Boat ke Pulau Menjangan: ± 20 menit</li>
                <li>Aktivitas laut (snorkeling/diving): 2 sesi @ 30 menit</li>
                <li>Istirahat & santai di pulau: ± 30 menit</li>
            </ul>
        </div>

        @auth
        <button @click="showModal = true" class="bg-mine-400 cursor-pointer text-white px-6 py-3 rounded">
            🎟️ Pesan Tiket Sekarang
        </button>
        <div x-show="showModal" x-cloak
            class="fixed inset-0 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50">
            <div @click.away="showModal = false"
                class="bg-white dark:bg-neutral-600 w-full max-w-5xl p-6 rounded shadow-lg relative">
                <h2 class="text-xl font-semibold mb-4">Form Pemesanan Tiket</h2>
                <form action="{{ route('checkout.store') }}"
                    x-data="{pax : 1, price: {{ Setting::where('key', 'harga')->value('value') }}, pickup : false}"
                    method="POST">
                    @csrf

                    <div class="w-full">
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            @if (Auth::user()->is_admin)
                            <div class="">
                                <flux:input wire:model="name" :label="__('Nama')" type="text" required autofocus
                                    autocomplete="name" />
                            </div>
                            <div class="">
                                <flux:input wire:model="email" :label="__('Email')" type="email" required
                                    autocomplete="email" />
                            </div>
                            @else
                            <div class="">
                                <flux:input :label="__('Nama')" readonly type="text" value="{{ Auth::user()->name }}" />
                            </div>
                            <div class="">
                                <flux:input :label="__('Email')" readonly type="email"
                                    value="{{ Auth::user()->email }}" />
                            </div>
                            @endif
                            <div class="">
                                <flux:input wire:model="whatsapp" placeholder="62XXXXXXXXXXX" class="text-white"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    :label="__('Nomor Whatsapp')" type="text" required autocomplete="whatsapp" />
                            </div>
                            <div class="">
                                <flux:input wire:model="pax" x-model="pax" autofocus :label="__('Pax')" type="number"
                                    min="1" required autocomplete="pax" />
                            </div>
                            <div class="">
                                <flux:input wire:model="date" :label="__('Tanggal Keberangkatan')" type="date"
                                    min="{{ $tanggalMinimal }}" required autocomplete="date" value="1" />
                            </div>
                        </div>
                        <label class="inline-flex mt-4 items-center">
                            <input type="checkbox" x-model="pickup" value="1"
                                class="form-checkbox accent-mine-400 text-green-600">
                            <span class="ml-2 text-sm text-gray-700 dark:text-neutral-100">Saya berdomisili di
                                singaraja</span>
                        </label>

                        <div class="mt-4" x-show="pickup" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0">
                            <flux:input wire:model="address" :label="__('Alamat Penjemputan')" type="text"
                                autocomplete="address"
                                placeholder="Masukan alamat lengkap untuk mempermudah penjemputan" />
                        </div>

                    </div>

                    <div class="flex justify-between mt-4">
                        <div class="w-full font-bold lg:w-1/4" x-text="'Total : IDR ' + price * pax">
                        </div>
                        <div class="flex justify-end  space-x-2">
                            <button type="button" @click="showModal = false"
                                class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-mine-400 cursor-pointer text-white rounded">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="bg-mine-400 cursor-pointer text-white px-6 py-3 rounded">
            🎟️ Pesan Tiket Sekarang
        </a>
        @endguest


    </flux:container>

    <livewire:pesan-tiket />

    <flux:container class="grid mt-[100px] grid-cols-1 md:grid-cols-2 gap-4 justify-between">
        <div class="aspect-square flex flex-col">
            <div class="text-center text-2xl font-semibold">Testimoni
            </div>
            <div class="swiper mySwiper mx-auto w-full h-full">
                <div class="flex gap-4 justify-end">
                    <div class="prev">
                        <flux:icon.chevron-left class="stroke-mine-400"></flux:icon.chevron-left>
                    </div>
                    <div class="next">
                        <flux:icon.chevron-right class="stroke-mine-400"></flux:icon.chevron-right>
                    </div>

                </div>
                <div class="swiper-wrapper w-full">
                    @foreach (App\Models\Review::where('show', true)->get() as $key => $item)
                    <div class="swiper-slide p-4">
                        <div class="flex gap-2 items-center">
                            <span
                                class="flex size-10 items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                {{ $item->user->initials() }}
                            </span>
                            <div class="text-lg">{{ $item->user->name }}</div>
                        </div>
                        <div class="flex mt-4 gap-0.5 items-center">
                            <div class="sr-only">rating</div>
                            @for ($i = 0; $i < floor($item->rate); $i++)
                                {{-- <i class="bx bxs-star text-yellow-500"></i> --}}
                                <flux:icon.star :variant="'micro'" class="stroke-mine-400 fill-mine-400">
                                </flux:icon.star>
                                @endfor
                                @for ($i = 5; $i > ceil($item->rate); $i--)
                                <flux:icon.star :variant="'micro'" class="stroke-gray-500"></flux:icon.star>
                                @endfor
                        </div>
                        <div class="mt-2">{{ $item->review }} </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="bg-center bg-cover bg-no-repeat aspect-square"
            style="background-image: url({{ asset('assets/testi.jpg') }})"></div>
    </flux:container>

    <flux:container>
        <div class="text-center mt-[100px] text-2xl font-semibold">Frequently Asked Question
        </div>
        <div class="flex flex-col gap-4 w-full mt-4 h-fit" x-data="{show:null}">
            @foreach (App\Models\FaQ::orderByDesc('order')->get() as $key => $item)
            <div class="bg-mine-100 dark:bg-neutral-700 rounded shadow">
                <div class="px-4 py-2 cursor-pointer text-sm md:text-base text-white bg-mine-400 items-center rounded flex justify-between"
                    @click="show = show === {{ $key }} ? null : {{ $key }}">
                    <div class="">{{$item->question }}</div>
                    <flux:icon.chevron-down :variant="'solid'" class="transition-all duration-300" />
                </div>
                <div class=" px-4 py-2 text-xs md:text-sm" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    x-show="show == {{ $key }}">{{ $item->answer }} </div>
            </div>
            @endforeach
        </div>
    </flux:container>

    <x-layouts.app.footer class="app footer">
    </x-layouts.app.footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 1,
          grid: {
            rows: 2,
          },
          loop:true,
          spaceBetween: 0,
          navigation: {
            nextEl: ".next",
            prevEl: ".prev",
         },
         autoplay:{ delay: 2500,
            disableOnInteraction: false,}
        });

        document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('open-modal', () => {
            Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).show = true;
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('formatHarga', () => ({
                formatRupiah(angka) {
                    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }));

                        // Tambahkan helper di global scope Alpine
                        Alpine.magic('formatRupiah', () => (angka) => {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            });
        });
    </script>
</x-layouts.app>
