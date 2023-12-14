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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('url')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('slide_start_date')->format('m/d/Y')->nullable();
            $table->string('slide_end_date')->format('m/d/Y')->nullable();
            $table->tinyInteger('slide_payment')->nullable();
            $table->string('slide_renew')->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('slides');
    }
};
