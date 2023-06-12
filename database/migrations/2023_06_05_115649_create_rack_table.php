<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('rack');
        Schema::create('rack', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouse')->onDelete('cascade');
            $table->string('name');
            $table->string('location');
            $table->string('rack_id');
            $table->string('category');
            $table->date('registered_date');
            $table->string('capacity');
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
        Schema::dropIfExists('rack');
    }
}
