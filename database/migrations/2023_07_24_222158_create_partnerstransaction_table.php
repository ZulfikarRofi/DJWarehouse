<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerstransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('partnerstransaction');
        Schema::create('partners_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partners_id')->constrained('partners')->onDelete('cascade');
            $table->foreignId('transaction_id')->constrained('transaction')->onDelete('cascade');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('partnerstransaction');
    }
}
