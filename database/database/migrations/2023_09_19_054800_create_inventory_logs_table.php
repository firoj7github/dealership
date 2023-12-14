<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dealer_id');
            $table->bigInteger('inventory_id');
            $table->integer('mpg_city')->nullable();
            $table->integer('mpg_hwy')->nullable();
            $table->integer('miles')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamp('edited_at')->nullable();
            $table->integer('price');
            $table->integer('purchase_price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_logs');
    }
};
