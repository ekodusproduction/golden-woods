<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $table = "enquiries";
    protected $guarded = [];

    public static function rules()
    {
        return [
            "name" => "required|string|max:255",
            "email" => "required|email|max:255", // Replace with your actual table name and column name
            "mobile" => [
                "required",
                "string",
                "regex:/^[0-9]{10}$/", // Enforce 10 digits with numbers only.
            ],
            "message" => "nullable|string",
            "projectId" => "nullable|integer|exists:projects,id",
        ];
    }
    

}
