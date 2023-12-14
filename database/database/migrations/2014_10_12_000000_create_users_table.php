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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('username')->nullable();
            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->string('adf_email')->nullable();
            $table->string('phone')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->tinyInteger('package')->nullable()->comment('St 0, Co 1, Si 2, Go 3, Pl 4, Pr 5, Ex 6, Bl 7');
            $table->tinyInteger('status')->default(1)->comment('A 1, I 0');
            $table->text('address')->nullable();
            $table->text('img')->nullable();
            $table->string('password_reset_otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('is_verify_email')->default(0);
            $table->string('password')->nullable();
            $table->text('website')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('salesperson')->nullable();
            $table->string('phone_type')->nullable();
            $table->string('contact_type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
