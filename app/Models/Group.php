<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'campaign_id'];

    public function rules() {
        return [
            "name"=>"required|unique:groups,name,".$this->id."|min:3",
            "campaign_id"=>"required|exists:campaigns,id"
        ];
    } 

    public function feedback() {
        return [
            "name.unique"=>"field :attribute must be unique",
            "name.required"=>"missing field :attribute",
            "min"=> ":attribute must have 3 charaters at least",
            "exists" => "campaign not found"
        ];
    } 

    public function cities(){
        return $this->hasMany('App\Models\City', 'group_id', 'id');
    }
}
