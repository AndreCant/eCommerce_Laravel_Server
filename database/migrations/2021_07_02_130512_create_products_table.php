<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price');
            $table->string('gender');
            $table->string('type');
            $table->string('sub_type')->nullable();
            $table->string('size_available')->nullable();
            $table->string('color');
            $table->string('material')->nullable();
            $table->string('collection');
        });

        DB::table('products')->insert(
            array(
                'name' => 'Nike Air Max 90',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eget magna fermentum iaculis eu non diam phasellus. Tellus pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Cras tincidunt lobortis feugiat vivamus. Sed pulvinar proin gravida hendrerit lectus. Id aliquet lectus proin nibh nisl condimentum id venenatis. Libero justo laoreet sit amet cursus sit. Sapien eget mi proin sed libero enim sed. Amet massa vitae tortor condimentum lacinia. Neque sodales ut etiam sit amet nisl purus. Id aliquet risus feugiat in ante metus dictum. Velit euismod in pellentesque massa placerat.',
                'price' => 139.99,
                'gender' => 'M',
                'type' => 'shoes',
                'sub_type' => 'lifestyle',
                'size_available' => 'M,L',
                'color' => 'grey',
                'material' => 'cotton',
                'collection' => 'fall/winter'
            )
        );

        DB::table('products')->insert(
            array(
                'name' => 'Puma Continental 80',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eget magna fermentum iaculis eu non diam phasellus. Tellus pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Cras tincidunt lobortis feugiat vivamus. Sed pulvinar proin gravida hendrerit lectus. Id aliquet lectus proin nibh nisl condimentum id venenatis. Libero justo laoreet sit amet cursus sit. Sapien eget mi proin sed libero enim sed. Amet massa vitae tortor condimentum lacinia. Neque sodales ut etiam sit amet nisl purus. Id aliquet risus feugiat in ante metus dictum. Velit euismod in pellentesque massa placerat.',
                'price' => 99.99,
                'gender' => 'M',
                'type' => 'shoes',
                'sub_type' => 'lifestyle',
                'size_available' => 'S,M,L',
                'color' => 'white',
                'material' => 'cotton',
                'collection' => 'fall/winter'
            )
        );

        DB::table('products')->insert(
            array(
                'name' => 'Tommy Jeans Runner Retrò',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eget magna fermentum iaculis eu non diam phasellus. Tellus pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Cras tincidunt lobortis feugiat vivamus. Sed pulvinar proin gravida hendrerit lectus. Id aliquet lectus proin nibh nisl condimentum id venenatis. Libero justo laoreet sit amet cursus sit. Sapien eget mi proin sed libero enim sed. Amet massa vitae tortor condimentum lacinia. Neque sodales ut etiam sit amet nisl purus. Id aliquet risus feugiat in ante metus dictum. Velit euismod in pellentesque massa placerat.',
                'price' => 49.99,
                'gender' => 'M',
                'type' => 'shoes',
                'sub_type' => 'lifestyle',
                'size_available' => 'M,L,XL',
                'color' => 'white',
                'material' => 'cotton',
                'collection' => 'fall/winter'
            )
        );

        DB::table('products')->insert(
            array(
                'name' => 'New Balance GW500',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eget magna fermentum iaculis eu non diam phasellus. Tellus pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Cras tincidunt lobortis feugiat vivamus. Sed pulvinar proin gravida hendrerit lectus. Id aliquet lectus proin nibh nisl condimentum id venenatis. Libero justo laoreet sit amet cursus sit. Sapien eget mi proin sed libero enim sed. Amet massa vitae tortor condimentum lacinia. Neque sodales ut etiam sit amet nisl purus. Id aliquet risus feugiat in ante metus dictum. Velit euismod in pellentesque massa placerat.',
                'price' => 47.95,
                'gender' => 'M',
                'type' => 'shoes',
                'sub_type' => 'lifestyle',
                'size_available' => 'S,M,L,XL',
                'color' => 'black/silver',
                'material' => 'cotton',
                'collection' => 'fall/winter'
            )
        );

        DB::table('products')->insert(
            array(
                'name' => 'Nike Performance FLEX EXPERIENCE RN 10',
                'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eget magna fermentum iaculis eu non diam phasellus. Tellus pellentesque eu tincidunt tortor aliquam nulla facilisi cras. Vestibulum rhoncus est pellentesque elit ullamcorper dignissim cras tincidunt lobortis. Cras tincidunt lobortis feugiat vivamus. Sed pulvinar proin gravida hendrerit lectus. Id aliquet lectus proin nibh nisl condimentum id venenatis. Libero justo laoreet sit amet cursus sit. Sapien eget mi proin sed libero enim sed. Amet massa vitae tortor condimentum lacinia. Neque sodales ut etiam sit amet nisl purus. Id aliquet risus feugiat in ante metus dictum. Velit euismod in pellentesque massa placerat.',
                'price' => 47.99,
                'gender' => 'M',
                'type' => 'shoes',
                'sub_type' => 'running',
                'size_available' => 'L',
                'color' => 'black/orange',
                'material' => 'cotton',
                'collection' => 'spring/summer'
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
        Schema::dropIfExists('products');
    }
}
