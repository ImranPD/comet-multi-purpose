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
            $table->string('name');
            $table->string('slug');
            $table->text('regular_price');
            $table->text('sale_price')->nullable();
            $table->text('desc')->nullable();
            $table->text('short_desc')->nullable();
            $table->integer('stock')->default(0);
            $table->text('photo')->nullable();
            $table->text('size')->nullable();
            $table->text('color')->nullable();
            $table->boolean('trend')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('trash')->default(false);
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
        Schema::dropIfExists('products');
    }
}
