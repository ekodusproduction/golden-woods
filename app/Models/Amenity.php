<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;
    protected $fillable = [
        "amenityName",
        "amenityImage",
    ];

    public static function createRules(){
        return [
            "amenityName"=>"required|string",
            "amenityImage"=>"required",
        ];
    }
    public static function updateRules(){
        return [
            "amenityName"=> "string",
            "amenityImage"=>"file",
        ];
    }

}
