<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Campaign;


class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Group::create(["name"=>"sudeste", "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id]);
        Group::create(["name"=>"nordeste", "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id]);
        Group::create(["name"=>"centroeste", "campaign_id"=> Campaign::inRandomOrder()->get()->first()->id]);
    }
}
