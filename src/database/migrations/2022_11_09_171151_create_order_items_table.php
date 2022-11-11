<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga');
            $table->integer('qty');
            $table->decimal('total_harga');
            $table->timestamps();
            $table->foreignId('id_order')->constrained('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_kendaraan')->constrained('kendaraans')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
