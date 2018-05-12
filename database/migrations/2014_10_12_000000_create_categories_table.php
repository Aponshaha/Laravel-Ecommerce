<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('category_row_id');
            $table->string('category_name');
            $table->string('category_slug');
            $table->string('category_image');
            $table->string('category_description');
            $table->integer('parent_id');
            $table->integer('has_child');
            $table->integer('is_featured');
            $table->integer('level');
            $table->integer('count_product');
            $table->integer('category_sort_order');
            $table->string('meta_key');
            $table->string('meta_description');
            $table->timestamps();
        });
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
