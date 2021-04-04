<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfumes', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->integer('ml_perfume')->nullable();
            $table->integer('ml_water')->nullable();
            $table->integer('ml_alcohol')->nullable();
            $table->integer('ml_fragrance')->nullable();
            $table->string('name_fragrance')->nullable();
            $table->integer('ml_most_used_fragrance');
            $table->integer('amount_created');
            $table->integer('quantity_available_for_breeding');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfumes');
    }
}
