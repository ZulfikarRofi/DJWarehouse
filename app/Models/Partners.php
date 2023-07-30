<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    use HasFactory;
    protected $table = 'partners';

    public function product()
    {
        return $this->belongsToMany(Product::class, 'partners_product');
    }

    public function transaction()
    {
        return $this->belongsToMany('App\Models\Transaction');
    }
}
