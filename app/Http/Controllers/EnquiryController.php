<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $enquiry = Enquiry::all();
        return response()->json(["data"=> $enquiry, "status"=>200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), Enquiry::rules());
        if ($validator->fails()) {
            return response()->json([
                "message" => 'Oops!' . $validator->errors()->first(), "status" => 400
            ]);
        }
        $enquiry = Enquiry::create($request->all());
        return response()->json(["data"=> "Enquiry submitted.","status"=> 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEnquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $enquiry = Enquiry::find($request->id);
        return response()->json(["data"=> $enquiry,"status"=> 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnquiryRequest  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Find the Enquiry record by its ID.
        $enquiry = Enquiry::find($request->id);
    
        // Check if the Enquiry record exists.
        if (!$enquiry) {
            return response()->json(["message" => "Enquiry not found.", "status" => 404]);
        }
    
        // Check if the 'madeEnquiry' field is present in the request and update it.
        if ($request->has("madeEnquiry")) {
            $enquiry->madeEnquiry = $request->madeEnquiry;
            $enquiry->save();
        }
    
        // Return a JSON response indicating success.
        return response()->json(["message" => "Enquiry updated successfully.", "status" => 200]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        //
        $enquiry = Enquiry::find($request->id);
        if(!$enquiry){
            return response()->json(["message"=>"Enquiry not found.", "status"=>200]);
        }
        $enquiry->delete();
        return response()->json(["message"=> "Enquiry deleted.","status"=> 200]);

    }
}
