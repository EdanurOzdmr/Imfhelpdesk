<?php

use Illuminate\Database\Seeder;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'WFİT'
            ],
            [
                'product_name' => 'WBOX'
            ],
            [
                'product_name' => 'Walking Ginger'
            ],
            [
                'product_name' => 'Wiky Watch'
            ],
            [
                'product_name' => 'WiWatch'
            ]
        ]);
    }
}
