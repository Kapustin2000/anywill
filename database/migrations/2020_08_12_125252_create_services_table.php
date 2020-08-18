<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('input_type_id');
            $table->timestamps();
        });

        Schema::create('cremation_service', function (Blueprint $table) { 
            $table->foreignId('cremation_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
        });

        Schema::create('cemetery_service', function (Blueprint $table) {
            $table->foreignId('cemetery_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
        });


       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cremation_services');
        Schema::dropIfExists('cemetery_services');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_options');
    }
}
