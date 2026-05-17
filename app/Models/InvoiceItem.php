<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'item_id', 'item_name', 'category_name', 'item_price', 'quantity', 'subtotal'];
    protected $casts    = ['item_price' => 'integer', 'quantity' => 'integer', 'subtotal' => 'integer'];

    public function invoice() { return $this->belongsTo(Invoice::class); }
    public function item()    { return $this->belongsTo(Item::class); }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp. ' . number_format($this->subtotal, 0, ',', '.');
    }
}
