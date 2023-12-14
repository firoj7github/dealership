<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('subscriber_id')->nullable();
            $table->string('user_name')->nullable()->unique();
            $table->string('password');
            $table->string('phone',25)->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('blood_group')->nullable();
            $table->string('date_of_birth', 20)->nullable();
            $table->string('last_blood_donate_date', 20)->nullable();
            $table->tinyInteger('role');
            $table->string('email_verification_code', 50)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique(['email', 'subscriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
