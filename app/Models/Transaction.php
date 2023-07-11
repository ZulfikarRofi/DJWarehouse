<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';

    protected static function boot()
    {
        parent::boot();

        // static::created(function ($transaction) {
        //     $product = $transaction->product;
        //     $product->stock -= $transaction->total_out;
        //     $product->stock += $transaction->total_in;
        //     $product->save();
        // });
    }
}
