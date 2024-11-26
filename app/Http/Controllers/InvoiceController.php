<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function generate($orderId)
    {
        $order = Order::findOrFail($orderId);

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'total_amount' => $order->total_amount,
            'invoice_date' => now(),
        ]);

        return response()->json(['invoice' => $invoice], 201);
    }
}
