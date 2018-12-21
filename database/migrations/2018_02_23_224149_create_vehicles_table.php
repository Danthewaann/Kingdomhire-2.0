<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('make');
            $table->string('model');
            $table->unsignedTinyInteger('seats');
            $table->enum('status', ['Available', 'Unavailable', 'Out for hire'])->default('Available');
            $table->integer('vehicle_type_id')->unsigned()->nullable();
            $table->integer('vehicle_fuel_type_id')->unsigned()->nullable();
            $table->integer('vehicle_gear_type_id')->unsigned()->nullable();
            $table->integer('weekly_rate_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehicle_type_id')->references('id')->onDelete('Set null')->on('vehicle_types');
            $table->foreign('vehicle_fuel_type_id')->references('id')->onDelete('Set null')->on('vehicle_fuel_types');
            $table->foreign('vehicle_gear_type_id')->references('id')->onDelete('Set null')->on('vehicle_gear_types');
            $table->foreign('weekly_rate_id')->references('id')->onDelete('Set null')->on('weekly_rates');
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
