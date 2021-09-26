<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'group_id'];

    public function rules(){
        return [
            "name"=>"required|unique:cities,name,".$this->id."|min:3",
            "group_id"=>"required|exists:groups,id"
        ];
    }
    public function feedback(){
        return [
            "required" => "field :attribute must not be null",
            "exists" => "group not found",
            "name.unique"=> "city already exists",
            "min"=> ":attribute must have 3 charaters at least"
        ];
    }

    public function group(){
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
}
