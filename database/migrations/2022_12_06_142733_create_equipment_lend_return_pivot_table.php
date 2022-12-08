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
        Schema::create('equipment_lend_return_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('equipment_id')->unsigned()->index();
            $table->foreign('equipment_id')->references('id')->on('equipment')
                ->onDelete('cascade');

            $table->integer('lend_return_id')->unsigned()->index();
            $table->foreign('lend_return_id')->references('id')->on('lend_return_equipment_details')
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
        Schema::dropIfExists('equipment_lend_return_pivot');
    }
};
