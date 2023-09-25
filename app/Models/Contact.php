<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "subject",
        "madeContact"
    ];

    public static function rules(){
        return [
            "name"=> "required|string",
            "email"=>"required|email",
            "madeContact"=>"nullable|boolean"
        ];
    }

}
