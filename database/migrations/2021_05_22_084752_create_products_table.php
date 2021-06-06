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
            $table->unsignedBigInteger('admin_id')->index();
            $table->unsignedBigInteger('brand_id')->index();
            $table->string('sku');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('special_price', 8, 2)->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('featured')->default(0);

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
