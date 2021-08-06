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
            $table->bigInteger('user_id');
        });

        DB::table('registries')->insert(
            array(
                'name' => 'Andrea',
                'surname' => 'Cantagallo',
                'street' => 'Via Fasulla 123',
                'city' => 'Penne',
                'county' => 'PE',
                'postal_code' => 65017,
                'state' => 'Italy',
                'phone' => 3398745698,
                'user_id' => 1,
            )
        );

        DB::table('registries')->insert(
            array(
                'name' => 'Pippo',
                'surname' => 'Franco',
                'street' => 'Via Fasulla 899',
                'city' => 'L\'Aquila',
                'county' => 'AQ',
                'postal_code' => 66100,
                'state' => 'Italy',
                'phone' => 3398455698,
                'user_id' => 2,
            )
        );
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
