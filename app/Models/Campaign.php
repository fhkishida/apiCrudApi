<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function rules(){
        return [
            "name"=>"required|unique:campaigns,name,".$this->id."|min:3"
        ];
    }
    public function feedback(){
        return [
            "required" => "field :attribute must not be null",
            "exists" => "group not found",
            "name.unique"=> "city already exists",
            "min"=> ":attribute must have at least 3 charaters"
        ];
    }
    public function group(){
        return $this->hasOne('App\Models\Group', 'campaign_id', 'id');
    }
    public function values(){
        return $this->hasOne('App\Models\ProductValue', 'campaign_id', 'id');
    }
}
