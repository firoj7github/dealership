<?php

use App\Enums\InventoryStatus;
use App\Enums\ListingPlanOrPackageType;
use App\Enums\VisibilityStatus;
use App\Enums\VisibilityStatusOrInventoryStatus;
use App\Models\DealerInfo;
use App\Models\User;
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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DealerInfo::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->integer('dealer_id')->nullable();
            $table->enum('condition',['Used']);
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
            $table->string('certified',10)->nullable();
            $table->string('date_in_stock')->format('m/d/Y')->nullable();
            $table->text('description');
            $table->text('options')->nullable();
            $table->text('categorized_options')->nullable();
            $table->string('drive_train',100)->nullable();
            $table->string('fuel',100)->nullable();
            $table->tinyInteger('mpg_city')->nullable();
            $table->tinyInteger('mpg_hwy')->nullable();
            $table->string('ext_color_generic')->nullable();
            $table->string('ext_color_code')->nullable();
            $table->string('int_color_generic')->nullable();
            $table->string('int_color_code')->nullable();
            $table->string('engine_block_type')->nullable();
            $table->integer('transmission_speed')->nullable();
            $table->string('passenger_capacity',50)->nullable();
            $table->string('ext_color_hex_Code',50)->nullable();
            $table->string('int_color_hex_Code',50)->nullable();
            $table->text('image_from_url')->nullable();
            // $table->text('downloaded_image_links')->nullable(); // newly added
            $table->text('video_url')->nullable();
            $table->date('stock_date_formated')->nullable(); //new add for calculate stock date in fromated
            $table->double('payment_price')->nullable();  //count monthly payment after down payment
            $table->string('body_formated',100)->nullable();  //count monthly payment after down payment
            $table->tinyInteger('status')->default(InventoryStatus::Active->value);
            $table->tinyInteger('package')->default(ListingPlanOrPackageType::Platinum->value); // some change in this function ,check previous comment that are update
            $table->tinyInteger('is_feature')->default(0); // free for 0, feature for 1
            $table->timestamp('payment_date')->nullable(); //use for listing page
            $table->timestamp('active_till')->nullable();  //use for listing page
            $table->timestamp('featured_till')->nullable(); //use for listing page
            $table->tinyInteger('is_visibility')->default(VisibilityStatusOrInventoryStatus::Active->value);
            $table->timestamps();
            $table->softDeletes();
            // $table->enum('package',['free','featured'])->default('free');
            // $table->enum('is_display',['yes','no'])->default('yes')->comment('Display status: "yes" for display, "no" for no display');
            // $table->enum('is_archive',['yes','no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};



// tmp_inventory_id
// dealer_id
// condition
// stock
// vin
// year
// make
// model
// body
// trim
// model_number
// doors
// exterior_color
// interior_color
// engine_cylinder
// engine_displacement
// transmission
// miles
// price
// retails
// book_value
// invoice
// certified
// date_in_stock
// description
// options
// categorized_options
// dealer_name
// dealer_address
// dealer_city
// dealer_state
// dealer_zip
// dealer_phone
// dealer_fax
// dealer_email
// comment_1
// comment_2
// comment_3
// comment_4
// comment_5
// style_description
// ext_color_generic
// ext_color_code
// int_color_generic
// int_color_code
// int_upholstery
// engine_block_type
// engine_aspiration_type
// engine_description
// transmission_speed
// transmission_description
// drive_train
// fuel
// mpg_city
// mpg_hwy
// epa_classification
// wheelbase_code
// internet_price
// misc_price_1
// misc_price_2
// misc_price_3
// factory_codes
// market_class
// passenger_capacity
// ext_color_hex_Code
// int_color_hex_Code
// engine_displacement_cubicInches
// image_from_url
// stock_date_formated
// payment_price
// body_formated
// status
