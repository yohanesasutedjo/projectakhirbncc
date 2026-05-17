<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'invoice_number', 'shipping_address', 'postal_code', 'total_price'];
    protected $casts    = ['total_price' => 'integer'];

    public function user()         { return $this->belongsTo(User::class); }
    public function invoiceItems() { return $this->hasMany(InvoiceItem::class); }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp. ' . number_format($this->total_price, 0, ',', '.');
    }

    public static function generateInvoiceNumber(): string
    {
        $date   = now()->format('Ymd');
        $last   = self::whereDate('created_at', today())->count() + 1;
        $serial = str_pad($last, 4, '0', STR_PAD_LEFT);
        return "INV-{$date}-{$serial}";
    }
}
