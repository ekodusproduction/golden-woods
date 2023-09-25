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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
 
        $validator = Validator::make($request->all(), ProjectGallery::rules());
        if ($validator->fails()){
            return response()->json(["message" => 'Oops!' . $validator->errors()->first(), "status" => 400]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function getById(Request $request)
    {
        $projectGallery = ProjectGallery::where("projectId",$request->id)->get();
        if ($projectGalleries->isEmpty()) {
            return response()->json(["message" => "No galleries found for the specified projectId.", "status" => 404]);
        }
        return response()->json(["data"=> $projectGallery, "status"=>200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectGalleryRequest  $request
     * @param  \App\Models\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        ProjectGallery::where("projectId",$request->id)->delete();
        if($request->hasFile('gallery')){
            $uploadedFiles = $request->file('gallery');
            // Loop through each uploaded file.
            foreach ($uploadedFiles as $file) {
                // Perform actions for each file, such as storing, processing, or validating.
                // Example: Store the file in the public directory with a unique name.
                $data = $file->store('');
                ProjectGallery::create(["projectId"=>$request->id, "galleryId"=>$data]);
            }
            // You can return a response or perform other actions after processing the files.
            return response()->json(['message' => 'Files uploaded successfully']);
        }
        return response()->json(['message' => 'No files provided.']);
    }

    /**
     * Remove the specified resource from storage.
     *     
     * @param  \App\Models\ProjectGallery  $projectGallery
     * @return \Illuminate\Http\Response
     */

}
