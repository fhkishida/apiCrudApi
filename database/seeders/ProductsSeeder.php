<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "name"=>"Massagem",
            "value"=> 170.90
        ]);
        Product::create([
            "name"=>"Hidroterapia",
            "value"=> 230.00
        ]);
    }
}
