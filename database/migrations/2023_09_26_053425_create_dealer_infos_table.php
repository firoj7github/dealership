<?php

use App\Models\Inventory;
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
        Schema::create('dealer_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('dealer_name',100)->nullable();
            $table->string('dealer_address')->nullable();
            $table->string('dealer_city')->nullable();
            $table->string('dealer_state')->nullable();
            $table->string('dealer_zip')->nullable();
            $table->string('dealer_phone')->nullable();
            $table->string('dealer_fax')->nullable();
            $table->string('dealer_email')->nullable();
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
        Schema::dropIfExists('dealer_infos');
    }
};
