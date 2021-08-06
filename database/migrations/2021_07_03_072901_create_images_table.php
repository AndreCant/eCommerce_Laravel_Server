<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('product_id')->nullable();
            $table->string('path');
            $table->boolean('is_primary');
        });

        DB::table('images')->insert(
            array(
                'product_id' => 1,
                'path' => 'https://img01.ztat.net/article/spp-media-p1/84020aa605d43a9cbbfab57a801e5972/4be645d7fd7d415f94e869c9a9fa463e.jpg?imwidth=1800&filter=packshot',
                'is_primary' => true
            )
        );

        DB::table('images')->insert(
            array(
                'product_id' => 2,
                'path' => 'https://img01.ztat.net/article/spp-media-p1/9ede1e9749693fd994cb80c23a8ad7ee/1b673dc5368142b49b562ad9a0287bec.jpg?imwidth=1800&filter=packshot',
                'is_primary' => true
            )
        );

        DB::table('images')->insert(
            array(
                'product_id' => 3,
                'path' => 'https://img01.ztat.net/article/spp-media-p1/6ba50e9811d53851821475a33e902d22/3628e2d1266a4631b494f6704d966b0b.jpg?imwidth=762&filter=packshot',
                'is_primary' => true
            )
        );

        DB::table('images')->insert(
            array(
                'product_id' => 4,
                'path' => 'https://img01.ztat.net/article/spp-media-p1/30f536642fb83ebf94f9d079d0d8839c/0adf416db51a4f018c5347b9e9f105db.jpg?imwidth=1800&filter=packshot',
                'is_primary' => true
            )
        );

        DB::table('images')->insert(
            array(
                'product_id' => 5,
                'path' => 'https://img01.ztat.net/article/spp-media-p1/00b862ccf905454b9edbdf158c109d93/079cfd10cfcb4c7c93ce88ca7c3d4a8f.jpg?imwidth=762&filter=packshot',
                'is_primary' => true
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
        Schema::dropIfExists('images');
    }
}
