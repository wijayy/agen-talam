<x-layouts.admin :title="__('Dashboard')">
    <div class="p-4 space-y-4">
        <div class="w-full  bg-white dark:bg-neutral-700 rounded p-4">
            <div class="capitalize text-lg font-semibold lg:text-xl ">{{ date("F Y") }} Sales</div>
            <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-4">
                <div class="aspect-4/3 lg:aspect-video rounded-lg flex flex-col p-2  bg-slate-50 dark:bg-neutral-600">
                    <flux:icon.wallet class="lg:size-12! stroke-amber-400"></flux:icon.wallet>
                    <div class="text-lg mt-auto lg:text-4xl font-bold">{{ number_format($totalThisMonth/1000,0, ',',
                        '.') }}K </div>
                    <div class="mt-1 text-sm lg:text-lg font-semibold">Total pendapatan bulan ini</div>
                    <div class="mt-1 text-xs lg:text-sm text-amber-400">{{ $percentTotal > 0 ? "+" : "" }}{{
                        $percentTotal }}% dibandingkan bulan lalu </div>
                </div>
                <div class="aspect-4/3 lg:aspect-video rounded-lg flex flex-col p-2  bg-slate-50 dark:bg-neutral-600">
                    <flux:icon.ticket class="lg:size-12! stroke-teal-400"></flux:icon.ticket>
                    <div class="text-lg mt-auto lg:text-4xl font-bold">{{ number_format($countThisMonth,0, ',', '.') }}
                    </div>
                    <div class="mt-1 text-sm lg:text-lg font-semibold">Total transaksi bulan ini</div>
                    <div class="mt-1 text-xs lg:text-sm text-teal-400">{{ $percentCount > 0 ? "+" : "" }}{{
                        $percentCount }}% dibandingkan bulan lalu </div>
                </div>
                <div class="aspect-4/3 lg:aspect-video rounded-lg flex flex-col p-2  bg-slate-50 dark:bg-neutral-600">
                    <flux:icon.users class="lg:size-12! stroke-pink-400"></flux:icon.users>
                    <div class="text-lg mt-auto lg:text-4xl font-bold">{{ number_format($averagePaxThisMonth,0, ',',
                        '.') }} </div>
                    <div class="mt-1 text-sm lg:text-lg font-semibold">Rata-rata pax bulan ini</div>
                    <div class="mt-1 text-xs lg:text-sm text-pink-400">{{ $percentAvgPax > 0 ? "+" : "" }}{{
                        $percentAvgPax }}% dibandingkan bulan lalu </div>
                </div>
                <div class="aspect-4/3 lg:aspect-video rounded-lg flex flex-col p-2  bg-slate-50 dark:bg-neutral-600">
                    <flux:icon.user-plus class="lg:size-12! stroke-blue-400"></flux:icon.user-plus>
                    <div class="text-lg mt-auto lg:text-4xl font-bold">{{ number_format($newUsersThisMonth,0, ',', '.')
                        }} </div>
                    <div class="mt-1 text-sm lg:text-lg font-semibold">Total user baru bulan ini</div>
                    <div class="mt-1 text-xs lg:text-sm text-blue-400">{{ $percentUsers > 0 ? "+" : "" }}{{
                        $percentUsers }}% dibandingkan bulan lalu </div>
                </div>
            </div>
        </div>
        <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2 bg-white dark:bg-neutral-700 rounded p-4">
            <div class="">
                <div class="text-lg font-semibold">Keberangkatan Tanggal {{ $date }} </div>
                <div class="">
                    <div class="flex mt-2 border-y border-black dark:border-neutral-300">
                        <div class="w-3/12 font-semibold text-center">Nomor Transaksi</div>
                        <div class="w-1/12 font-semibold text-center">Pax</div>
                        <div class="w-1/6 font-semibold text-center">Whatsapp</div>
                        <div class="w-4/12 font-semibold text-center">Penjemputan</div>
                        <div class="w-1/6 font-semibold text-center">Pembayaran</div>
                    </div>
                    @forelse ($transaksi as $item)
                    <div class="flex items-center py-1 last:border-b border-black dark:border-neutral-300">
                        <div class="w-3/12 text-center">{{ $item->nomor_transaksi }} </div>
                        <div class="w-1/12 text-center">{{ $item->pax }} </div>
                        <div class="w-1/6 text-center"><a target="_blank" href="https://wa.me/{{ $item->whatsapp }}">{{
                                $item->whatsapp }}</a> </div>
                        <div class="w-4/12 text-center">{{ $item->address ?? "-" }} </div>
                        <div class="w-1/6 text-center">{{ $item->statusPembayaran ? "Lunas" : "Belum Dibayar" }} </div>
                    </div>
                    @empty
                    <div class="h-full w-full flex items-center justify-center">Anda tidak memiliki keberangkatan</div>
                    @endforelse
                </div>
                <div class="mt-4">
                    <a class="hover:text-mine-400 pl-4 flex gap-3" href="{{ route('review.index') }}">Lihat semua
                        transaksi <flux:icon.arrow-up-right variant="mini" class=""></flux:icon.arrow-up-right> </a>
                </div>
            </div>
            <div class="">
                <div class="text-lg font-semibold">5 Review Terakhir </div>
                <div class="">
                    @foreach ($reviews as $item)
                    <div class="mt-2">
                        <div class="flex gap-0.5 items-center">
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
                        <div class="">{{ $item->review }} </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a class="hover:text-mine-400 pl-4 flex gap-3" href="{{ route('review.index') }}">Lihat semua review
                        <flux:icon.arrow-up-right variant="mini" class=""></flux:icon.arrow-up-right> </a>
                </div>
            </div>
        </div>
        <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-3 bg-white dark:bg-neutral-700 rounded p-4">
            <div class="w-full h-80">
                <canvas id="reviewChart" class="w-full h-full"></canvas>
            </div>
            <div class="w-full h-80">
                <canvas id="chartTransaksi" class="w-full h-full"></canvas>
            </div>
            <div class="w-full h-80">
                <canvas id="viewsChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#fff' : '#000';

        const ctx1 = document.getElementById('viewsChart')?.getContext('2d');
        if (!ctx1) return; // biar gak error kalau canvas belum ada

        const chart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: @json($monthsViews->pluck('label')),
            datasets: [{
                label: 'Total Pengunjung',
                data: @json($monthsViews->pluck('total')),
                borderColor: '#fb64fb',
                backgroundColor: '#fb64fb11',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
    legend: {
      labels: {
        color: textColor
      }
    }
  },
  scales: {
    x: {
      ticks: {
        color: textColor
      }
    },
    y: {
      ticks: {
        color: textColor
      }
    }
  }
        }
        });
        const ctx = document.getElementById('chartTransaksi').getContext('2d');

        const labels = @json($labels);
        const data = @json($data);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
    legend: {
      labels: {
        color: textColor
      }
    }
  },
  scales: {
    x: {
      ticks: {
        color: textColor
      }
    },
    y: {
      ticks: {
        color: textColor
      }
    }
  }
            }
        });

        const ctx2 = document.getElementById('reviewChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($chartData)) !!},
            datasets: [{
                label: 'Jumlah Review',
                data: {!! json_encode(array_values($chartData)) !!},
                backgroundColor: [
                    'oklch(65.6% 0.241 354.308)', // 5
                    'oklch(66.7% 0.295 322.15)', // 1
                    'oklch(68.5% 0.169 237.323)', // 2
                    'oklch(76.8% 0.233 130.85)', // 3
                    'oklch(76.9% 0.188 70.08)', // 4
                    'oklch(63.7% 0.237 25.331)'  // belum review
                ],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
    legend: {
      labels: {
        color: textColor
      }
    }
  },
  scales: {
    x: {
      ticks: {
        color: textColor
      }
    },
    y: {
      ticks: {
        color: textColor
      }
    }
  }
        }
    });
    });
    </script>
</x-layouts.admin>
