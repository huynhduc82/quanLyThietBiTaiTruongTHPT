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
        Schema::create('recoup', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('equipment_id');
            $table->string('reason')->nullable();
            $table->string('recoup_method');
            $table->integer('quantity')->unsigned()->nullable();
            $table->float('amount_of_money')->nullable();
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
        Schema::dropIfExists('recoup');
    }
};
