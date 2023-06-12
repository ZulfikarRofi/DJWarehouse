<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('product_number');
            $table->string('image')->nullable();
            $table->string('product_type');
            $table->string('quality');
            $table->string('size');
            $table->string('merk');
            $table->string('colors');
            $table->string('class')->nullable();
            $table->integer('stock')->default(0);
            $table->bigInteger('sell_price');
            $table->bigInteger('buy_price');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
