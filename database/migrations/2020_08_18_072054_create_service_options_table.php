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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('service_options')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->unsignedInteger('input_type_id')->nullable();
            $table->unsignedBigInteger('meta_data_id')->nullable();
        });


        Schema::create('service_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->unsigned()->constrained()->onDelete('cascade');
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
    }
}
