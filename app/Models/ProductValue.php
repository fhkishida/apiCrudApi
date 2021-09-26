<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'campaign_id', 'discount'];

    public function rules() {
        return [
            "product_id"=>"required|exists:products,id",
            "campaign_id"=>"required|exists:campaigns,id",
            "discount"=>"required"
        ];
    } 

    public function feedback() {
        return [
            "name.unique"=>"field :attribute must be unique",
            "required"=>"missing field :attribute",
            "exists" => ":attribute not found"
        ];
    } 

    public function product(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function campaign(){
        return $this->hasOne('App\Models\Campaign', 'id', 'campaign_id');
    }
}
