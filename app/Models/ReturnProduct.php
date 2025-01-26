<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    protected $fillable = [
        'sale_id',
        'sales_item_id',
        'quantity',
        'amount_refunded',
        'reason',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function salesItem()
    {
        return $this->belongsTo(SalesItem::class);
    }
}
