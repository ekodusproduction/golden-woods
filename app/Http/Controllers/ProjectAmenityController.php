<?php

namespace App\Http\Controllers;

use App\Models\ProjectAmenity;
use App\Models\ProjectGallery;
use App\Models\Project;
use App\Models\Amenity;

use Illuminate\Http\Request;

class ProjectAmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Reqeust $request)
    // {
    //     //
    //     $amenities = ProjectAmenity::all();
    //     return response()->json(["data"=> $amenities, "status"=>200]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectAmenityRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectAmenity  $projectAmenity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $project = ProjectAmenity::find($request->id); 
        if(!$project){
            return response()->json(["message"=> "Project not found.","status"=> 404]);
        }
        return response()->json(["data"=>$project, "status"=>200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectAmenity  $projectAmenity
     * @return \Illuminate\Http\Response
     */

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectAmenityRequest  $request
     * @param  \App\Models\ProjectAmenity  $projectAmenity
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectAmenity  $projectAmenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $amenityId = $request->input('id');

        // Find and delete rows with matching projectId.
        $deletedRows = ProjectAmenity::where('amenityId', $amenityId)->delete();
    
        if ($deletedRows > 0) {
            return response()->json(["message" => " Amenity removed successfully.", "status" => 200]);
        } else {
            return response()->json(["message" => "No amenities found.", "status" => 404]);
        }
    }
}
