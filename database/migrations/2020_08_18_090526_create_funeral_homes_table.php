<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuneralHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funeral_homes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('funeral_home_services', function (Blueprint $table) {
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
        });

        Schema::create('funeral_home_options', function (Blueprint $table) {
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_options_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funeral_homes');
    }
}
