<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optionables', function (Blueprint $table) {
            $table->id();
            $table->morphs('optionable');
            $table->foreignId('service_options_id')->constrained()->onDelete('cascade');
            $table->integer('commission')->nullable();
            $table->json('media')->nullable();

            $table->index(['optionable_id', 'optionable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('optionables');
    }
}
