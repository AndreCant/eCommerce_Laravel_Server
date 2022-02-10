<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name');
            $table->longText('title')->nullable();
            $table->longText('sub_title')->nullable();
            $table->longText('image')->nullable();
        });

        DB::table('banners')->insert(
            array(
                'name' => 'carousel',
                'title' => '<p class="text-white text-uppercase mb-20">Men shoes</p>
                            <h4 class="text-white text-capitalize mb-25">Running Shoes</h4>
                            <h2 class="text-white mb-40">Sale 40% Off</h2>',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/h3tUX4R0pvn4dtIxNXyiGKokH9MqDPrpmbRKsVVi.jpg'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'men',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/vRZXkFvVnJqKilo681rIYGkvcCNmruFLwhMEPk7w.jpg'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'women',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/mGXIFZHWhuWr5S99alzPmWA0AlxFmISYgeFGbfZ5.jpg'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'kids',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/EN6dqEUvDnLGtNW2EbzlXiTv95Z4lyKzLvnQ4Gjx.jpg'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'shipping',
                'title' => 'Free Shipping',
                'sub_title' => 'On all orders over €75,00',
                'image' => 'http://127.0.0.1:8000/uploads/images/VwDlq2dga7ghu26Q5P9cPNvkzT27kVRCRj08knBd.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'returns',
                'title' => 'Free Returns',
                'sub_title' => 'Returns are free within 9 days',
                'image' => 'http://127.0.0.1:8000/uploads/images/6yljVZhsWhf3x9b3rZvSd0rwAK9dWN4Ch0nLC7Q4.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'secure',
                'title' => '100% Payment Secure',
                'sub_title' => 'Your payment are safe with us',
                'image' => 'http://127.0.0.1:8000/uploads/images/iGxvk6hR6nipeVB3ykDj9LkmvIbm9Afgw3waCSIa.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'support',
                'title' => 'Support 24/7',
                'sub_title' => 'Contact us 24 hours a day',
                'image' => 'http://127.0.0.1:8000/uploads/images/YfwLx2ZwYFXg1tsTRBqxYaD4MlTnStv2kIEYl0Lw.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'logo',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/CYaSJncLUM5lqkGcgMlYIJ5aTHpAZjs5N4FrvFpF.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'payment',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/ovKiA7HzbKgtBcjuJag2iVyBUDrWwwsjK9KWLMXT.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'appStore',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/nnvXX9OadVkVmq1CqA0uMPqnyPb9UvAROx4070we.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'googlePlay',
                'title' => '',
                'sub_title' => '',
                'image' => 'http://127.0.0.1:8000/uploads/images/cSwMWwzCpQDj0J5mMKUAsxMtUATzkXpJvdtRTRfW.png'
            )
        );

        DB::table('banners')->insert(
            array(
                'name' => 'newsletter',
                'title' => 'Newsletter',
                'sub_title' => 'You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.',
                'image' => ''
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
        Schema::dropIfExists('banners');
    }
}
