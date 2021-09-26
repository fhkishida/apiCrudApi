<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Group;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // City::create([
        //     "name"=>
        //     "group_id"=> 
        // ]);
        City::create([
            "name"=>"Ribeirao Preto",
            "group_id"=> Group::select("id")->where("name", "sudeste")->first()->id
        ]);
        City::create([
            "name"=>"Salvador",
            "group_id"=> Group::select("id")->where("name", "nordeste")->first()->id
        ]);
        City::create([
            "name"=>"Brasilia",
            "group_id"=> Group::select("id")->where("name", "centroeste")->first()->id
        ]);
        City::create([
            "name"=>"Sao Paulo",
            "group_id"=> Group::select("id")->where("name", "sudeste")->first()->id
        ]);

    }
}
