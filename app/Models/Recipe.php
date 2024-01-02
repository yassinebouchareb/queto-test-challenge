<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $casts = [
        'valid' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function scopeValid($query)
    {
        return $query->where('valid', true);
    }

    public function scopeInvalid($query)
    {
        return $query->where('valid', false);
    }
}
