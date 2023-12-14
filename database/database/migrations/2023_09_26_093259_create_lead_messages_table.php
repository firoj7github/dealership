<?php

use App\Models\Lead;
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
        Schema::create('lead_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lead::class)->constrained()->cascadeOnDelete()->nullable();
            $table->bigInteger('sender_id')->nullable();
            $table->bigInteger('receiver_id')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('is_seen')->default(0);
            $table->text('file')->nullable();
            $table->text('report_history')->nullable();
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
        Schema::dropIfExists('lead_messages');
    }
};
