<?php

namespace App\Http\Controllers;

use App\Models\ProjectGallery;
use App\Models\Project;
use App\Models\Amenity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{

    public function create(Request $request)
    {   
        $galleries = ProjectGallery::where("projectId", $request->id);
        if(!empty($galleries)){
            Storage::delete($galleries->image);
        }
        ProjectGallery::where("projectId", $request->id)->delete();
        $uploadedFiles = $request->allFiles();
        if (!empty($uploadedFiles)) {
            foreach ($uploadedFiles as $file) {
                $data = $file->store('public/gallery');
                ProjectGallery::create(["projectId" => $request->id, "image" => $data]);
            }
            return response()->json(['message' => 'Files uploaded successfully']);
        }
        
        return response()->json(['message' => 'No files provided.']);
    }
    

    public function index(Request $request)
    {
        $projectGalleries = ProjectGallery::where("projectId",$request->id)->get();
        if ($projectGalleries->isEmpty()) {
            return response()->json(["message" => "No galleries found for the specified projectId.", "status" => 404]);
        }
        return response()->json(["data"=> $projectGalleries, "status"=>200]);
    }

}
