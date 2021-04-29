<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_id');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->string('city');
            $table->integer('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registries');
    }
}
