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
        Schema::create('equipment_reservation_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('equipment_details')->unsigned()->index();
            $table->foreign('equipment_details')->references('id')->on('equipment')
                ->onDelete('cascade');

            $table->integer('reservation_id')->unsigned()->index();
            $table->foreign('reservation_id')->references('id')->on('equipment_reservation_details')
                ->onDelete('cascade');

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
        Schema::dropIfExists('equipment_reservation_pivot');
    }
};
