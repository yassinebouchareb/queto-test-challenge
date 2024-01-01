<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'quantity', 'expiration_date'];

    protected $casts = [
        'expiration_date' => 'date',
    ];

    protected $appends = ['is_in_stock', 'is_expired'];

    public function getIsInStockAttribute()
    {
        return $this->quantity > 0;
    }

    public function getIsExpiredAttribute()
    {
        return $this->expiration_date->lessThan(Carbon::now()->format('Y-m-d'));
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)->withPivot('quantity');
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeExpired($query)
    {
        return $query->where('expiration_date', '<', Carbon::now()->format('Y-m-d'));
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', '<=', 0);
    }
}
