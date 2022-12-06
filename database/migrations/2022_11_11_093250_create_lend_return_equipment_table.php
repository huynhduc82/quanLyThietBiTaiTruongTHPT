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
        Schema::create('lend_return_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->timestamp('pick_up_time')->nullable();
            $table->bigInteger('lender_id')->nullable();
            $table->bigInteger('returner_id')->nullable();
            $table->timestamp('return_appointment_time')->nullable();
            $table->timestamp('return_time')->nullable();
            $table->bigInteger('room_id')->nullable();
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->bigInteger('updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('lend_return_equipment');
    }
};
