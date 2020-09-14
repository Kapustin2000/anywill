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
            $table->bigIncrements('id');
            $table->string('private_id',5)->unique();
            $table->morphs('owner');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('total_capacity')->nullable();
            $table->timestamps();

            $table->index(['owner_id', 'owner_type']);
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
