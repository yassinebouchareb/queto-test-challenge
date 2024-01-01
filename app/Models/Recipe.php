<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
