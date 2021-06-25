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
            $table->string('name')->nullable(true);
            $table->string('surname')->nullable(true);
            $table->string('street')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('county')->nullable(true);
            $table->integer('postal_code')->nullable(true);
            $table->string('state')->nullable(true);
            $table->bigInteger('phone')->nullable(true);
            $table->integer('user_id');
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
