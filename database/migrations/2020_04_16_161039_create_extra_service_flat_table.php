<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraServiceFlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_service_flat', function (Blueprint $table) {
            $table->unsignedBigInteger('flat_id');
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');

            $table->unsignedBigInteger('extra_service_id');
            $table->foreign('extra_service_id')->references('id')->on('extra_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_service_flat');
    }
}
