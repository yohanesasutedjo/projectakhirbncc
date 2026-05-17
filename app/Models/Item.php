<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'quantity', 'image'];
    protected $casts    = ['price' => 'integer', 'quantity' => 'integer'];

    public function category()    { return $this->belongsTo(Category::class); }
    public function invoiceItems(){ return $this->hasMany(InvoiceItem::class); }

    public function isOutOfStock(): bool { return $this->quantity <= 0; }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && file_exists(public_path('images/items/' . $this->image))) {
            return asset('images/items/' . $this->image);
        }
;        return asset('images/items/default.png');
    }
}
