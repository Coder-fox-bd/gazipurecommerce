<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->unsignedBigInteger('quantity')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->unsignedBigInteger('variant_id')->index();
            $table->unsignedBigInteger('product_attribute_id')->index();
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->foreign('product_attribute_id')->references('id')->on('product_attributes');
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
        Schema::dropIfExists('product_variants');
    }
}
