<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $validated = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'pax' => 'required|integer',
            'whatsapp' => 'required|string|doesnt_start_with:0',
            'address' => 'nullable|string',
            'date' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $validated['nomor_transaksi'] = "AT" . fake()->date('Ymd') . fake()->toUpper(fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter() . mt_rand(111, 999));
            $validated['user_id'] = Auth::user()->id;
            $validated['total'] = $validated['pax'] * Setting::where('key', 'harga')->value('value');

            $transaksi = Transaksi::create($validated);
            DB::commit();

            return redirect(route('checkout.show', ['checkout' => $transaksi->slug]));
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
     * Display the specified resource.
     */
    public function show(Transaksi $checkout)
    {

        if ($checkout->status_pembayaran != 'belum bayar')
            return redirect()->route('history.index')->with('success', "Transaksi $checkout->nomor_transaksi Sudah Dibayar!");

        // dd($checkout->nomor_transaksi);
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Buat Snap Token kalau belum ada
        if (!$checkout->snap_token) {
            $midtransParams = [
                'transaction_details' => [
                    'order_id' => $checkout->nomor_transaksi,
                    'gross_amount' => $checkout->total, // harga dari config
                ],
                'customer_details' => [
                    'first_name' => $checkout->name ?? $checkout->user->name,
                    'email' => $checkout->email ?? $checkout->user->email,
                    'phone' => $checkout->whatsapp,
                ],
            ];

            $snapToken = Snap::getSnapToken($midtransParams);
            $checkout->snap_token = $snapToken;
            $checkout->save();
        } else {
            $snapToken = $checkout->snap_token;
        }

        $transaksi = $checkout;

        return view('checkout', compact('snapToken', 'transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $checkout)
    {

        $checkout->update(['status_pembayaran' => 'sudah bayar']);

        return response()->json(['message' => 'Berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $checkout)
    {
        try {
            DB::beginTransaction();
            $checkout->update(['status_pembayaran' => 'dibatalkan']);
            DB::commit();
            return back()->with('success', 'Transaksi berhasil dibatalkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                return back()->with('error', $th->getMessage());
            }
        }
    }
}
