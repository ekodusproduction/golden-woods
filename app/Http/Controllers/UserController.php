<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\ResetPassword;
class UserController extends Controller
{

    
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => 'Oops!' . $validator->errors()->first(), "status" => 400]);
        }
        $admin = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), 
        ]);
    
        $admin->save();
        return response()->json(["data" => "Admin created successfully", "status" => 201]);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required",
             ]);
     
            if ($validator->fails()) {
                return response()->json(["message" => 'Oops! ' . $validator->errors()->first(), "status" => 400]);
             }
     
            $credentials = $request->only('email', 'password');
          
            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials', 'status' => 401]);
            }
             // If the credentials are correct, issue a Sanctum token
            $user = Auth::guard('sanctum')->user();
             // Issue a Sanctum token
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['token' => $token, 'message' => 'Login successful', 'status' => 200]);

        }catch (\Exception $e) {
            return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }

    public function sendPasswordResetMail(Request $request)
    {
        try {     
            if(!$request->email){
                return response()->json(['message'=>'Please send Email', 'status'=>400]);
            }
            $email = $request->email;

            $emailFound = User::where('email', $email)->get();
            if(!$emailFound){
                return response()->json(['message'=>'Email not registered', 'status'=>404]);
            }
            $token = Str::random(60);
             // Issue a Sanctum token

            return response()->json(['token' => $token, 'message' => 'Login successful', 'status' => 200]);

        }catch (\Exception $e) {
            return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }

    public function resetPassword(Request $request)
    {
        try {     
            $credentials = $request->only('email', 'password');
          
            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials', 'status' => 401]);
            }
             // If the credentials are correct, issue a Sanctum token
            $user = Auth::guard('sanctum')->user();
             // Issue a Sanctum token
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['token' => $token, 'message' => 'Login successful', 'status' => 200]);

        }catch (\Exception $e) {
            return response()->json(["message" => 'Oops! Something Went Wrong.' . $e->getMessage(), "status" => 500]);
        }
    }
}
