<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id");
            $table->foreignId("campaign_id");
            $table->double("discount",8,2);
            $table->timestamps();
            $table->foreign("product_id")->references('id')->on("products");
            $table->foreign("campaign_id")->references('id')->on("campaigns");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_values');
    }
}
