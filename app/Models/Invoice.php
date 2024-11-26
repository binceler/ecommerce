<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'total_amount', 'invoice_date'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
