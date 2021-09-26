<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value'];

    public function rules() {
        return [
            "name"=>"required|unique:products,name,".$this->id."|min:3",
            "value"=>"required"
        ];
    } 

    public function feedback() {
        return [
            "name.unique"=>"field :attribute must be unique",
            "required"=>"missing field :attribute",
            "min"=> ":attribute must have 3 charaters at least",
            "exists" => "campaign not found"
        ];
    } 
    public function values(){
        return $this->hasMany('App\Models\ProductValue', 'product_id', 'id');
    }
}
