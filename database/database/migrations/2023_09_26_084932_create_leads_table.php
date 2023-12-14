<?php

use App\Models\Customer;
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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tmp_inventories_id')->nullable();
            $table->foreignIdFor(Inventory::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->text('description')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('lead_type')->nullable();
            $table->string('year')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('mileage')->nullable();
            $table->string('color')->nullable();
            $table->string('vin')->nullable();
            $table->string('source')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('stage')->default(0)->comment('stage, Pending => 0, Working => 1, Completed => 2, Blocked => 3 ');
            $table->string('isEmailSend')->default('on');
            $table->tinyInteger('is_admin_read')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('leads');
    }
};
