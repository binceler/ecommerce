<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/a', function () {
    echo 'aaaa';
}); */

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/invoices/{orderId}', [InvoiceController::class, 'getInvoice']);
