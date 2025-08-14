<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Review;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


class BaseController extends Controller
{
    public function home()
    {
        $harga = config('Tiket.harga');

        $now = Carbon::now();
        $tanggalMinimal = $now->hour >= 23
            ? $now->addDays(2)->toDateString() // setelah jam 11 malam, min = lusa
            : $now->addDay()->toDateString();

        return view('home', compact('harga', 'tanggalMinimal'));
    }

    public function pesanTiket(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'pax' => 'required|integer',
            'whatsapp' => 'required|string|starts_with:62',
            'address' => 'nullable|string',
            'date' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $validated['nomor_transaksi'] = "AT" . fake()->date('Ymd') . fake()->toUpper(fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter());
            $validated['user_id'] = Auth::user()->id;
            $validated['total'] = $validated['pax'] * config('Tiket.harga');

            Transaksi::create($validated);
            DB::commit();

            return redirect(route('history.index'));
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                return back()->with('error', $th->getMessage());
            }
        }
    }

    public function config() {
        $settings = Setting::all();

        return view('config', compact('settings'));
    }
    
    public function storeConfig(Request $request) {
        $validated = $request->validate([
            'harga' => 'required|integer',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string',
        ]);

        foreach ($request->only(['harga', 'alamat', 'nomor_telepon']) as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }

    public function dashboard()
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        // Bulan ini
        $totalThisMonth = Transaksi::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total');

        $countThisMonth = Transaksi::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $averagePaxThisMonth = Transaksi::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->avg('pax');

        $newUsersThisMonth = User::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Bulan lalu
        $totalLastMonth = Transaksi::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('total');

        $countLastMonth = Transaksi::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $averagePaxLastMonth = Transaksi::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->avg('pax');

        $newUsersLastMonth = User::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        // Fungsi helper persentase
        $persen = fn($thisMonth, $lastMonth) => $lastMonth != 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100, 2)
            : ($thisMonth > 0 ? 100 : 0);

        $percentTotal = $persen($totalThisMonth, $totalLastMonth);
        $percentCount = $persen($countThisMonth, $countLastMonth);
        $percentAvgPax = $persen($averagePaxThisMonth, $averagePaxLastMonth);
        $percentUsers = $persen($newUsersThisMonth, $newUsersLastMonth);

        $views = DB::table('page_views')
            ->selectRaw("DATE_FORMAT(viewed_at, '%Y-%m') as month, COUNT(*) as total")
            ->where('viewed_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Buat array bulan dan data lengkap 12 bulan ke belakang
        $monthsViews = collect(range(0, 11))->map(function ($i) use ($views) {
            $date = now()->subMonths($i)->startOfMonth();
            $month = $date->format('Y-m');
            return [
                'label' => $date->format('F Y'),
                'total' => $views[$month]->total ?? 0,
            ];
        })->reverse()->values();

        $bulanSekarang = now();
        $bulanAwal = now()->subMonths(11)->startOfMonth();

        $transaksiPerBulan = Transaksi::selectRaw('
                DATE_FORMAT(date, "%Y-%m") as bulan,
                SUM(total) as total_transaksi
            ')
            ->whereBetween('date', [$bulanAwal, $bulanSekarang])
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total_transaksi', 'bulan')
            ->toArray();

        // Buat array lengkap 12 bulan terakhir
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = now()->subMonths($i)->format('Y-m');
            $labels[] = Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y');
            $data[] = $transaksiPerBulan[$bulan] ?? 0;
        }

        $total = Transaksi::count();

        $ratings = Transaksi::with('review')
            ->get()
            ->groupBy(function ($transaksi) {
                return $transaksi->review?->rate ?? 'Belum Review';
            })
            ->map(fn($group) => $group->count());

        $chartData = [
            '1 Bintang' => $ratings[1] ?? 0,
            '2 Bintang' => $ratings[2] ?? 0,
            '3 Bintang' => $ratings[3] ?? 0,
            '4 Bintang' => $ratings[4] ?? 0,
            '5 Bintang' => $ratings[5] ?? 0,
            'Belum Review' => $ratings['Belum Review'] ?? 0,
        ];

        $jamSekarang = $now->format('H:i:s');

        // Tentukan tanggal yang digunakan untuk filter
        $tanggalFilter = $jamSekarang < '14:00:00'
            ? $now
            : $now->addDay();

        // Apply ke query dengan scope yang kamu punya
        $transaksi = Transaksi::filters([
            'date' => $tanggalFilter->toDateString()
        ])->get();

        $date = $tanggalFilter->format('d F Y');

        $reviews = Review::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalThisMonth',
            'countThisMonth',
            'averagePaxThisMonth',
            'newUsersThisMonth',
            'percentTotal',
            'percentCount',
            'percentAvgPax',
            'percentUsers',
            'monthsViews',
            'labels',
            'data',
            'chartData',
            'transaksi',
            'date',
            'reviews'
        ));
    }
}
