<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('product_row_id');
            $table->string('product_name');            
            $table->double('product_price');
            $table->string('product_height');
            $table->string('product_width');
            $table->string('product_weight');
            $table->string('product_sku');
            $table->string('product_image');
            $table->string('product_description');
            $table->tinyInteger('is_latest' )->default(0);
            $table->tinyInteger('is_featured' )->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('category_row_id')
            ->references( 'category_row_id' )->on( 'categories' )
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
        });
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
