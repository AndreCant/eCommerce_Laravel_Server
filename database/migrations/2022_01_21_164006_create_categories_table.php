<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('type_name');
            $table->longText('sub_types')->nullable();
        });

        DB::table('categories')->insert(
            array(
                'type_name' => 'shoes',
                'sub_types' => 'lifestyle;running;tennis'
            )
        );

        DB::table('categories')->insert(
            array(
                'type_name' => 'clothing',
                'sub_types' => 'top;pants;shorts'
            )
        );

        DB::table('categories')->insert(
            array(
                'type_name' => 'accessories',
                'sub_types' => 'bags;hats;watches'
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
        Schema::dropIfExists('categories');
    }
}
