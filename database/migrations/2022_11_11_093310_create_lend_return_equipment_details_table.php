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
        Schema::create('lend_return_equipment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lend_return_equipment_id');
            $table->bigInteger('type_of_equipment_id');
            $table->integer('quantity')->unsigned();
            $table->string('equipment_status_id')->nullable();
            $table->string('recoup_id')->nullable();
            $table->string('equipment_details')->nullable();
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
        Schema::dropIfExists('lend_return_equipment_details');
    }
};
