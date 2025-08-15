<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        DB::table('page_views')->insert([
            'page' => request()->path(),
            'ip_address' => request()->ip(),
            'viewed_at' => now(),
        ]);

        $transaksi = Transaksi::where('user_id', Auth::user()->id)->whereIn('status_pembayaran', ['sudah dibayar', 'belum bayar'])->orderBy('created_at', 'DESC')->paginate(perPage: 12);
        $today = Carbon::today(); // Hanya tanggal hari ini (tanpa jam)
        $now = Carbon::now(); // Tanggal + jam saat ini
        // $transaksi = [];
        return view("history.index", compact("transaksi", "today", "now"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $history)
    {
        $validated = $request->validate([
            'rate' => 'required|integer',
            'review' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $validated['transaksi_id'] = $history->id;
            $validated['user_id'] = Auth::user()->id;

            Review::create($validated);
            DB::commit();
            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                return back()->with('error', $th->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
