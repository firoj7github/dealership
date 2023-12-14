<?php

use App\Models\Inventory;
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
        Schema::create('inventory_additional_info', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Inventory::class)->constrained()->cascadeOnDelete();
            $table->string('comment_1')->nullable();
            $table->string('comment_2')->nullable();
            $table->string('comment_3')->nullable();
            $table->string('comment_4')->nullable();
            $table->string('comment_5')->nullable();
            $table->string('style_description')->nullable();
            $table->string('int_upholstery')->nullable();
            $table->string('engine_aspiration_type')->nullable();
            $table->string('engine_description')->nullable();
            $table->string('transmission_description')->nullable();
            $table->string('epa_classification')->nullable();
            $table->float('wheelbase_code')->nullable();
            $table->double('internet_price',50)->nullable();
            $table->double('misc_price_1',50)->nullable();
            $table->double('misc_price_2',50)->nullable();
            $table->double('misc_price_3',50)->nullable();
            $table->text('factory_codes')->nullable();
            $table->string('market_class')->nullable();
            $table->string('engine_displacement_cubicInches',100)->nullable();
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
        Schema::dropIfExists('inventory_additional_info');
    }
};
