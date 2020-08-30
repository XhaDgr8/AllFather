<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsSubProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_sub_products', function (Blueprint $table) {

            $table->primary(['sub_product_id', 'product_id']);

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sub_product_id');

            $table->decimal('quantity',  9, 3)->default(1)->nullable();
            $table->timestamps();

            $table->foreign('sub_product_id')
                ->references('id')
                ->on('sub_products')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
