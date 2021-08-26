<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for ($i=1; $i < 48000; $i++) { 
            $data[] = [
                'collection_id' => 1,
                'product_id'  => $i,
            ];
        }

        $chunks = array_chunk($data, 5000);
        foreach ($chunks as  $chunk) {
            DB::table('collection_products')->insert($chunk);
        }
    }
}
