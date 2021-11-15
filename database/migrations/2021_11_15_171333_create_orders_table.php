<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('status', ['In Progress', 'Delivered', 'Canceled']);
            $table->string('code');
            $table->bigInteger('payment_id');
            $table->bigInteger('user_id');
        });

        DB::table('orders')->insert(
            array(
                'code' => 'MWT-0001',
                'payment_id' => 1,
                'status' => 'In Progress',
                'user_id' => 1
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
        Schema::dropIfExists('orders');
    }
}
