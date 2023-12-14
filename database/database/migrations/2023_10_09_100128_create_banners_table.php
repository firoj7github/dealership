<?php

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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->text('banner_price')->nullable();
            $table->string('start_date')->format('m/d/Y')->nullable();
            $table->string('end_date')->format('m/d/Y')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('payment')->nullable()->default(0);
            $table->string('renew')->nullable();
            $table->string('position')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
};
