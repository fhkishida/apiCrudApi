<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;

class CampaignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::create(["name"=>"blackfriday"]);
        Campaign::create(["name"=>"dia das mães"]);
        Campaign::create(["name"=>"dia das crianças"]);
        Campaign::create(["name"=>"dia dos pais"]);
    }
}
