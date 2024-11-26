<?php

namespace App\Http\Controllers;

use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function getInvoice($orderId)
    {
        $invoice = Invoice::where('order_id', $orderId)->first();

        if (!$invoice) {
            return response()->json([
                'message' => 'Invoice not found for the given order ID.',
            ], 404);
        }

        return response()->json(['invoice' => $invoice], 200);
    }
}
