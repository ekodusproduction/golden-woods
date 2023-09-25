<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json(["data"=> $contacts, "status"=>200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), Contact::rules());
        if($validator->fails()){
            return response()->json(["message" => 'Oops!' . $validator->errors()->first(), "status" => 400]);
        }
        $contact = Contact::create(request()->all());
        return response()->json(["message"=>"Contact submitted successfully" ,"status"=> 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $contact = Contact::find($request->id);
        return response()->json(["data"=> $contact,"status"=> 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        // dump($request);
        if(!$request->madeContact){
            return response()->json(["message"=> "Invalid request.","status"=>400]);
        }
        $contact = Contact::find($request->id);
        $contact->madeContact = $request->madeContact;
        $contact->save();
        return response()->json(["message"=> "Contact updated.","status"=> 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $contact = Contact::find($request->id);
        $contact->delete();
        return response()->json(["message"=> "Contact deleted","status"=> 200]);
    }
}
