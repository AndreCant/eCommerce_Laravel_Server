<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->bigInteger('number');
            $table->integer('year');
            $table->integer('month');
            $table->integer('cvv');
            $table->bigInteger('user_id');
        });

        DB::table('payments')->insert(
            array(
                'name' => 'Pippo',
                'surname' => 'Franco',
                'number' => 8958965412365847,
                'year' => 2025,
                'month' => 04,
                'cvv' => 987,
                'user_id' => 2
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
        Schema::dropIfExists('payments');
    }
}
