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

        Schema::create('cremation_services', function (Blueprint $table) {
            $table->bigInteger('cremation_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
        });

        Schema::table('cremation_services', function($table) { 
            $table->foreign('cremation_id')->references('id')->on('cremations')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });

        Schema::create('cemetery_services', function (Blueprint $table) {
            $table->bigInteger('cemetery_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
        });

        Schema::table('cemetery_services', function($table) {
            $table->foreign('cemetery_id')->references('id')->on('cemeteries')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });


        Schema::create('service_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('service_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('service_options', function($table) {
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

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
