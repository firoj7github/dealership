<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscriber_id');
            $table->bigInteger('added_by');
            $table->string('name', 150);
            $table->string('phone', 20);
            $table->string('image', 150)->nullable();
            $table->tinyInteger('blood_group');
            $table->tinyInteger('district');
            $table->integer('upozila')->unsigned();
            $table->string('last_blood_donate_date', 20)->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('institution', 160)->nullable();
            $table->tinyInteger('status')->default(PENDING_STATUS);
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
        Schema::dropIfExists('donors');
    }
}
