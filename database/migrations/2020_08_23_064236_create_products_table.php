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
            $table->bigIncrements('id');
            $table->string('cat_number', 400)->nullable();
            $table->string('name', 400)->nullable();
            $table->longText('description')->nullable();
            $table->decimal('stock_quantity',  9, 3)->nullable();
            $table->integer('price_for_customer')->nullable();
            $table->integer('price_for_admin')->nullable();
            $table->integer('other_costs')->nullable();
            $table->longText('image')->nullable();
            $table->longText('image_alt')->nullable();
            $table->string('category', 400)->nullable();
            $table->string('key_words', 400)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('products');
    }
}
