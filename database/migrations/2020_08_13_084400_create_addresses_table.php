<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('administrative_area_level_1');
            $table->string('administrative_area_level_2');
            $table->string('country');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('neighborhood')->nullable();
            $table->string('name')->nullable();
            $table->string('postal_code_suffix')->nullable();
            $table->string('locality');
            $table->string('place_id');
            $table->string('postal_code');
            $table->string('route');
            $table->string('street_number');
            $table->string('formatted_address');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['addressable_id', 'addressable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
