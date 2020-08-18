<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('service_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('cremation_service_options', function (Blueprint $table) {
            $table->foreignId('cremation_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_options_id')->constrained()->onDelete('cascade');
        });

        Schema::create('cemetery_service_options', function (Blueprint $table) {
            $table->foreignId('cemetery_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_options_id')->constrained()->onDelete('cascade');
        });

        Schema::create('laboratory_service_options', function (Blueprint $table) {
            $table->foreignId('laboratory_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('service_options');
        Schema::dropIfExists('entity_options');
    }
}
