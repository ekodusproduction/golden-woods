<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        "projectId",
        "image",
    ];

    public static function rules(){
        return [
            "projectId"=>"required|integer|exists:projects,id",
            "image"=>"required|string",
        ];
    }
}
