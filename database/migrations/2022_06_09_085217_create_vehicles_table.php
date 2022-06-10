<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('model_id');
            $table->string('vin')->default('');
            $table->unsignedInteger('fuel_type_id');
            $table->integer('engine_volume')->default(0);
            $table->integer('year')->default();
            $table->float('cost')->default(0);
            $table->unsignedInteger('country_id');

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('model_id')->references('id')->on('models');
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
