<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MidtransCallbackController;

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'success']);
