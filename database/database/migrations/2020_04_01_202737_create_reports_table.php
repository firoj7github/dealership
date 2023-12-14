<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscriber_id');
            $table->bigInteger('donor_id');
            $table->bigInteger('present_volunteer_id')->nullable();
            $table->bigInteger('responsible_volunteer_id')->nullable();
            $table->string('name_of_patient', 80)->nullable();
            $table->string('name_of_hospital', 80)->nullable();
            $table->string('contact_number', 20);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
