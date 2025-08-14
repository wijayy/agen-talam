<x-layouts.admin title="Customer`s Review" class="app">
    <div class="p-4">
        <div class="text-xl font-semibold">All Review to Agen Talam</div>
        <flux:session></flux:session>

        <div class="font-semibold">Preview</div>
        <flux:container class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between">
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
                style="background-image: url({{ asset('build/assets/testi.jpg') }})"></div>
        </flux:container>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            @foreach ($reviews as $item)
            <form action="{{ route('review.update', ['review'=>$item->id]) }}" method="post" class="p-4">
                @csrf
                @method('put')
                <div class="flex rounded bg-mine-400 p-2 justify-between">
                    <div class="flex gap-2 items-center">
                        <span
                            class="flex size-10 items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                            {{ $item->user->initials() }}
                        </span>
                        <div class="text-lg">{{ $item->user->name }}</div>
                    </div>
                    <flux:action-a as class="underline underline-offset-2"> {{ $item->show ? "hide" : "show" }} </flux:action-a>
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
            </form>
            @endforeach
        </div>

        <div class="">{{ $reviews->links() }} </div>
    </div>

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
    </script>
</x-layouts.admin>
