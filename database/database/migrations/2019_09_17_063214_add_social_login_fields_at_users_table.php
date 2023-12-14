<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialLoginFieldsAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_social_login')->default(false);
            $table->string('social_network_id', 180)->nullable();
            $table->string('social_network_type', 20)->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_subscriber_id_unique');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique(['email', 'subscriber_id', 'social_network_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_social_login');
            $table->dropColumn('social_network_id');
            $table->dropColumn('social_network_type');
        });
    }
}
