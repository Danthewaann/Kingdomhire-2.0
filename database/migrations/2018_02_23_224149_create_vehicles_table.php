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
            $table->string('make');
            $table->string('model');
            $table->string('fuel_type');
            $table->string('gear_type');
            $table->unsignedTinyInteger('seats');
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['Available', 'Unavailable', 'Out for hire'])->default('Available');
            $table->string('type');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('vehicle_rate_id')->unsigned()->nullable();
            $table->foreign('vehicle_rate_id')->references('id')->onDelete('Set null')->on('vehicle_rates');
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
