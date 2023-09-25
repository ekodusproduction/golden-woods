<?php

namespace App\Http\Controllers;

use App\Models\ProjectAmenity;
use App\Models\ProjectGallery;
use App\Models\Project;
use App\Models\Amenity;

use Illuminate\Http\Request;

class ProjectAmenityController extends Controller
{
    public function create(Request $request)
    {      
        $project = Project::find($request->projectId);
        if(!$project){
            return response()->json(["message"=> "Project not found.","status"=>404]);
        }
        $amenity = Amenity::find($request->amenityId);
        if(!$amenity){
            return response()->json(["message"=> "Amenity not found.","status"=>404]);
        }
        
        $projectAmenity = ProjectAmenity::create($request->all());
        return response()->json(["message"=> "Amenity added to project.","status"=>201]);
    }

    public function show(Request $request)
    {
        $project = ProjectAmenity::find($request->id); 
        if(!$project){
            return response()->json(["message"=> "Project not found.","status"=> 404]);
        }
        return response()->json(["data"=>$project, "status"=>200]);
    }
 
    public function destroy(Request $request)
    {
        $amenityId = $request->input('id');
        $deletedRows = ProjectAmenity::where('amenityId', $amenityId)->delete();
    
        if ($deletedRows > 0) {
            return response()->json(["message" => " Amenity removed successfully.", "status" => 200]);
        } else {
            return response()->json(["message" => "No amenities found.", "status" => 404]);
        }
    }
}
