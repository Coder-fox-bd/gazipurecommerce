<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i=1; $i < 50000; $i++) { 
            $data[] = [
                'category_id' => 1,
                'product_id'  => $i,
            ];
        }

        $chunks = array_chunk($data, 5000);
        foreach ($chunks as  $chunk) {
            DB::table('category_products')->insert($chunk);
        }
    }
}
