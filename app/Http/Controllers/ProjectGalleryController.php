<?php

namespace App\Http\Controllers;

use App\Models\ProjectGallery;
use App\Models\Project;
use App\Models\Amenity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class ProjectGalleryController extends Controller
{
    public function create(Request $request)
    {   
 
        ProjectGallery::where("projectId",$request->id)->delete();
        if($request->hasFile('gallery')){
            $uploadedFiles = $request->file('gallery');
            foreach ($uploadedFiles as $file) {
       
                $data = $file->store('');
                ProjectGallery::create(["projectId"=>$request->id, "galleryId"=>$data]);
            }
            return response()->json(['message' => 'Files uploaded successfully']);
        }
        return response()->json(['message' => 'No files provided.']);
    }

    public function getById(Request $request)
    {
        $projectGallery = ProjectGallery::where("projectId",$request->id)->get();
        if ($projectGalleries->isEmpty()) {
            return response()->json(["message" => "No galleries found for the specified projectId.", "status" => 404]);
        }
        return response()->json(["data"=> $projectGallery, "status"=>200]);
    }

}
