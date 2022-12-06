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
        Schema::create('image_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_name');
            $table->string('image_references');
            $table->string('image_path');
            $table->string('disk');
            $table->string('image_type');
            $table->Integer('image_size');
            $table->Integer('image_width');
            $table->Integer('image_height');
            $table->string('url');
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
        Schema::dropIfExists('image_info');
    }
};
