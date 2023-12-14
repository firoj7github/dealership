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
        Schema::create('archived_tmp_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tmp_inventory_id');
            $table->integer('dealer_id')->nullable();
            $table->enum('condition',['Used','New']);
            $table->string('stock',100);
            $table->string('vin');
            $table->string('year',50);
            $table->string('make',200);
            $table->string('model',200);
            $table->string('body',200);
            $table->string('trim',50)->nullable();
            $table->string('model_number',200)->nullable();
            $table->tinyInteger('doors')->nullable();
            $table->string('exterior_color',100)->nullable();
            $table->string('interior_color',100)->nullable();
            $table->tinyInteger('engine_cylinder')->nullable();
            $table->string('engine_displacement',100)->nullable();
            $table->enum('transmission',['Automatic','Variable','Manual'])->nullable();
            $table->integer('miles')->nullable();
            $table->double('price');
            $table->double('retails')->nullable();
            $table->double('book_value')->nullable();
            $table->integer('invoice')->nullable();
            $table->enum('certified',['TRUE','FALSE'])->nullable();
            $table->string('date_in_stock')->format('m/d/Y')->nullable();
            $table->text('description');
            $table->text('options')->nullable();
            $table->text('categorized_options')->nullable();
            $table->string('dealer_name',100)->nullable();
            $table->string('dealer_address')->nullable();
            $table->string('dealer_city')->nullable();
            $table->string('dealer_state')->nullable();
            $table->string('dealer_zip')->nullable();
            $table->string('dealer_phone')->nullable();
            $table->string('dealer_fax')->nullable();
            $table->string('dealer_email')->nullable();
            $table->string('comment_1')->nullable();
            $table->string('comment_2')->nullable();
            $table->string('comment_3')->nullable();
            $table->string('comment_4')->nullable();
            $table->string('comment_5')->nullable();
            $table->string('style_description')->nullable();
            $table->string('ext_color_generic')->nullable();
            $table->string('ext_color_code')->nullable();
            $table->string('int_color_generic')->nullable();
            $table->string('int_color_code')->nullable();
            $table->string('int_upholstery')->nullable();
            $table->string('engine_block_type')->nullable();
            $table->string('engine_aspiration_type')->nullable();
            $table->string('engine_description')->nullable();
            $table->integer('transmission_speed')->nullable();
            $table->string('transmission_description')->nullable();
            $table->string('drive_train',100)->nullable();
            $table->string('fuel',100)->nullable();
            $table->tinyInteger('mpg_city')->nullable();
            $table->tinyInteger('mpg_hwy')->nullable();
            $table->string('epa_classification')->nullable();
            $table->float('wheelbase_code')->nullable();


            $table->double('internet_price',50)->nullable();
            $table->double('misc_price_1',50)->nullable();
            $table->double('misc_price_2',50)->nullable();
            $table->double('misc_price_3',50)->nullable();
            $table->text('factory_codes')->nullable();
            $table->string('market_class')->nullable();
            $table->string('passenger_capacity',50)->nullable();
            $table->string('ext_color_hex_Code',50)->nullable();
            $table->string('int_color_hex_Code',50)->nullable(); 
            $table->string('engine_displacement_cubicInches',100)->nullable(); 
            $table->text('image_from_url')->nullable(); 
            $table->date('stock_date_formated')->nullable(); //new add for calculate stock date in fromated
            $table->double('payment_price')->nullable();  //count monthly payment after down payment  
            $table->string('body_formated',100)->nullable();  //count monthly payment after down payment  
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // $table->string('engine_aspiration_type')->nullable();
            // $table->string('engine');
            // $table->string('transmission2');
            // $table->integer('mileage')->nullable();
            // $table->text('picture_from_url')->nullbale();
            // $table->string('sub_category')->nullable();
            // $table->integer('category_id')->nullable();
            // $table->integer('sub_category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archived_tmp_inventories');
    }
};
