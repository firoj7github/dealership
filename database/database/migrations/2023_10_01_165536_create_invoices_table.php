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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->tinyInteger('package')->default('0');
            $table->bigInteger('banner_id')->nullable();
            $table->bigInteger('lead_id')->nullable();
            $table->bigInteger('slider_id')->nullable();
            $table->bigInteger('inventory_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->double('discount')->nullable();
            $table->integer('price')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('due_date')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
