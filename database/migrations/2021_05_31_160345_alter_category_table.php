<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->text('description')->nullable()->after('slug');
            $table->boolean('featured')->default(0)->after('category_id');
            $table->boolean('menu')->default(1)->after('featured');
            $table->string('image')->nullable()->after('menu');
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
