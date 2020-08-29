<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cat_number', 400)->nullable();
            $table->string('name', 400)->nullable();
            $table->longText('description')->nullable();
            $table->string('country_of_origin', 400)->nullable();
            $table->string('facility_name', 400)->nullable();
            $table->string('buying_unit', 400)->nullable();
            $table->string('price_per_unit', 400)->nullable();
            $table->string('production_unit', 400)->nullable();
            $table->string('production_price', 400)->nullable();
            $table->string('stock_quantity', 400)->nullable();
            $table->string('price_for_customer', 400)->nullable();
            $table->string('price_for_admin', 400)->nullable();
            $table->string('other_costs', 400)->nullable();
            $table->string('image', 400)->nullable();
            $table->string('image_alt', 400)->nullable();
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
        Schema::dropIfExists('sub_products');
    }
}

