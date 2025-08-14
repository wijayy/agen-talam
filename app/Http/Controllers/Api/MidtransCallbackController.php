<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function success(Request $request)
    {
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $transactionStatus = $request->input('transaction_status');

        $transaksi = Transaksi::where('nomor_transaksi', $orderId)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        if (in_array($transactionStatus, ['capture', 'settlement'])) {
            $transaksi->update(['status_pembayaran' => 'sudah dibayar']);
        }

        return response()->json(['message' => 'Pembayaran berhasil diterima']);
    }
}
