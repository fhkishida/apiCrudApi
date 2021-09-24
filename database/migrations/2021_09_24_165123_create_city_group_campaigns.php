<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityGroupCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_group_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("city_groups_id");
            $table->timestamps();
            $table->foreign('city_groups_id')->references('id')->on('city_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_group_campaigns');
    }
}
