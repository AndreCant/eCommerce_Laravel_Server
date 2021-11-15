<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_line_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('product_id');
            $table->bigInteger('order_id');
            $table->string('size');
            $table->integer('quantity');
            $table->string('code');
        });

        DB::table('order_line_items')->insert(
            array(
                'code' => 'OLI-0001',
                'quantity' => 5,
                'size' => 'M',
                'order_id' => 1,
                'product_id' => 1
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
        Schema::dropIfExists('order_line_items');
    }
}
