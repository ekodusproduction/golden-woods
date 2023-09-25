<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable  = [
        "projectName",
        "status",
        'isActive',
        "description",
        "location", 
        "projectVideo",
        "projectImage",
        "approvedPlan",
        "brochure",
        'projectNoc',
    ];

    public static function createRules(){
        return [
            'projectName'=>'string|unique:projects',
            'status'=> 'string|in:ongoing,completed',
            'description' => 'string',
            'location' => 'string|max:255',
            'projectImage'=>'required',
            'projectVideo'=>'required',
            'approvedPlan'=> 'required',
            'brochure' => 'required',
            'projectNoc' => 'required',
        ];
    }

    public static function hideRules(){
        return [
            'isActive' => 'required|boolean',
        ];
    }
}
