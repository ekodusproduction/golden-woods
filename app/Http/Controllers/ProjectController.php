<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
class ProjectController extends Controller
{
/**
     * @OA\Post(
     *      path="/projects",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Project::createRules());
    
            if ($validator->fails()) {
                return response()->json(["message" => "Oops!" . $validator->errors()->first(), "status" => 400]);
            }
    
            // Check if 'projectName' is present in the request.
            if (!$request->has('projectName')) {
                return response()->json(["message" => "Oops! 'projectName' is required.", "status" => 400]);
            }
            $projectData =[
                'projectName' => $request->projectName,
                'description' => $request->description,
                'status' => $request->status,
                'location' => $request->location,
            ];
           
            $projectData["projectImage"] = $request->projectImage->store('public/image');
            $projectData["projectVideo"] = $request->projectVideo->store('public/video');
            $projectData["approvedPlan"] = $request->approvedPlan->store('public/plans');
            $projectData["brochure"] = $request->brochure->store('public/brochures');
            $projectData["projectNoc"] = $request->projectNoc->store('public/nocs');
            $project = Project::create($projectData);
    
            return response()->json(["message" => "Project created successfully", "status" => 201]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Handle duplicate entry error (error code 1062) for 'projects_projectname_unique'.
                return response()->json(["message" => "Project name already exists.", "status" => 400]);
            } else {
                return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
            }
        }
    }

    public function getById(Request $request)
    {  
        try{
        $project = Project::find($request->id);
        // Handle the case where the project was not found
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
        // Return the project
            return response()->json(["data"=>$project, "status"=>200]);
        }catch (\Exception $e) {
            return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }

    /**
     * @OA\Get(
     *      path="/projects",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function getList(Request $request)
    {try{
        $list = Project::select('id', "projectName")->get();
        return response()->json(["data"=>$list, "status"=>200]);
    } catch (\Exception $e) {
        return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }

   
    public function edit(Request $request)
    {
        try {
            $projectId = $request->id;
            $project = Project::find($projectId);
            if (!$project) {
                return response()->json(["message" => "Project not found.", "status" => 404]);
            }
            $projectName = $request->projectName;
            print $projectName;
            if($request->has('projectName') && !($request->projectName === $project->projectName)) {
                $project->projectName = $request->projectName;
            }
            if($request->has('status') && ($request->status === "ongoing" || $request->status === "completed")) {
                $project->status = $request->status;
            }
            if($request->has('description')){
                $project->description = $request->description;
            }
            if($request->has('location')){
                $project->location = $request->location;
            }     
            if($request->has('isActive')){
                $project->isActive = $request->isActive;
            }
            if($request->hasFile('projectImage')){
                $project->projectImage = $request->projectName->store('');
            }
            if($request->hasFile('approvedPlan')){
                $project->projectName = $request->projectName->store('');
            }
            if($request->hasFile('brochure')){
                $project->projectName = $request->projectName->store('');
            }
            if($request->hasFile('projectNoc')){
                $project->projectName = $request->projectName->store('');
            }
            $project->save();
            return response()->json(["message" => "Project Modified.", "status" => 200]);
        } catch (\Exception $e) {
            return response()->json(["message" => "Internal server error.", "status" => 500]);
        }
    }
    

    public function destroy(Request $request)
    {
        try{
        $project = Project::find($request->id);
        if($request->hasFile('projectImage')){
            Storage::delete($project->projectImage);
        }
        if($request->hasFile('approvedPlan')){
            Storage::delete($project->approvedPlan);
        }
        if($request->hasFile('brochure')){
            Storage::delete($project->brochure);
        }
        if($request->hasFile('projectNoc')){
            Storage::delete($project->projectNoc);
        }
        if(!$project){
            return response()->json(["message" => "Project not found.", "status" => 404]);
        }
        $project->delete();
        return response()->json(["message"=> "Project deleted successfully.", "status"=>200]);
    } catch (\Exception $e) {
        return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }
}
