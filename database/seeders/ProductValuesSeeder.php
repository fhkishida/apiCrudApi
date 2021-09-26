<?php

namespace Database\Seeders;
use App\Models\ProductValue;
use App\Models\Product;
use App\Models\Campaign;

use Illuminate\Database\Seeder;

class ProductValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductValue::create([
            "product_id"=> Product::inRandomOrder()->get()->first()->id,
            "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id,
            "discount"=> 113.3
        ]);
        ProductValue::create([
            "product_id"=> Product::inRandomOrder()->get()->first()->id,
            "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id,
            "discount"=> 92.3
        ]);
        ProductValue::create([
            "product_id"=> Product::inRandomOrder()->get()->first()->id,
            "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id,
            "discount"=> 73.3
        ]);
    }
}
