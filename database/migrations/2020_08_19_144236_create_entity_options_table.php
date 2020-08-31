<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_options', function (Blueprint $table) {
            $table->morphs('entity_options');
            $table->foreignId('service_options_id')->constrained()->onDelete('cascade');
            $table->integer('commission')->nullable();
            $table->json('media')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_options');
    }
}
