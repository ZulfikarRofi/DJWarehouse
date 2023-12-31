<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = ['stock'];

    public function transaction()
    {
        //
        return $this->hasMany(Transaction::class);
    }

    public function product_partners()
    {
        return $this->belongsToMany(Partners::class, 'partners_product');
    }
}
