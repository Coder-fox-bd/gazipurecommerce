<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DailyHome;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DailyHomeUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'home:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update New Arrived and Recomended products daily!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DailyHome::query()->delete();

        $daily_homes = [
            [
                'name' => 'new',
            ],
            [
                'name' => 'recomended'
            ]
        ];

        foreach ($daily_homes as $daily_home) {
            DailyHome::create($daily_home);
        }

        DB::table('daily_home_pivot')->delete();

        $home = DailyHome::get();
        $new = [];
        $recomended = [];
        $products = collect(Product::all()->modelKeys());
        for ($i=1; $i < 9; $i++) { 
            $new[] = [
                'daily_home_id' => $home[0]->id,
                'product_id'  => $products->random(),
            ];
        }

        for ($i=1; $i < 9; $i++) { 
            $recomended[] = [
                'daily_home_id' => $home[1]->id,
                'product_id'  => $products->random(),
            ];
        }

        foreach ($new as  $value) {
            DB::table('daily_home_pivot')->insert($value);
        }

        foreach ($recomended as  $data) {
            DB::table('daily_home_pivot')->insert($data);
        }

        $this->info('Successfully optimized home.');
    }
}
