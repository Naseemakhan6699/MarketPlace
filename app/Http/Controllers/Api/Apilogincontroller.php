<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sociallogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class Apilogincontroller extends Controller
{
    function signUp(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
          
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 202,
                'message' => 'validation error',
                'erorrs' => $validator->errors(),
            ],202);
        }
            $user = DB::table('users')->insert([

                'name' => $request->name,              
                'email' => $request->email,                
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
              
            ]);
    
         
            if($user){
                return response()->json([
                    'status'=>200,
                    'message'=>'Registerd successfully',
                    'user'=>$user,
                ],200);
        }else{
            return response()->json([
                'status'=>202,
                'message'=>'Not Registerd!',
            ], 202);
        }


    }




    function login(Request $request)
    {
        // dd($request->email);
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'erorrs' => $validator->errors(),
            ]);
        }
        $user= User::where('email', $request->email)->first();
        // dd($user);
        if(!$user)
        {
             return  response()->json([
                 'status'=>200,
            'message' => 'Invalid Email Address',
           
        ],200); 
        }
        else
        {
           
         
            if($user->status == "1")
            {
                  return  response()->json([
                      'status'=>202,
                'message' => ['Your Account is Block please contact with administration.']
            ], 202);
            }
         if($request->email)
        {
            if (auth()->attempt(['email' => $request->input('email') , 'password' => $request->input('password')])) {
                $user = auth()->user();
                $token = $user->createToken('auth:sanctum')->plainTextToken;
                // $userToken = $user->createToken()->accessToken;
                return response()->json([
                    'userDetails' => $user,
                    "token" => $token,
                    "message" => 'login successfuuly'
                   
                ], 200); 
            }
        }
        else{
            return response()->json([
                'status'=>'401',
                'message' => 'Invalid credentials'
                   ], 401);
        } 
        }
       
    }
    public function socialsignup(Request $request)
    {
        // $sociallogin=Sociallogin::where('email',$request->email)->first();
        $sociallogin=User::where('email',$request->email)->first();
        if(!$sociallogin)
        {
            $user=new User();
            $user->name=$request->name??"user_name";
            $user->email=$request->email;
            $user->password=bcrypt("Passw0rd");
            $user->status=1;
            $user->role=$request->role;
            $user->save();
     
            $user1=new Sociallogin();
            $user1->name=$request->name??"user_name";
            $user1->email=$request->email;
            $user1->password=bcrypt("Passw0rd");
            $user1->save();
            
            $token = $user->createToken('token')->plainTextToken;       
            if($user){
               
             return response()->json([
                 'status'=>200,
                 'message'=>'User login Successfully',
                 'user'=>$user,
                 'token' => $token
             ],200);
            }
        }
        else{


            if (!Hash::check('Passw0rd', $sociallogin->password)) {
                return  response()->json([
                    'message' => ['Already exist']
                ], 404);
            }
            $user=User::where('email',$request->email)->first();
 
            $token = $sociallogin->createToken('token')->plainTextToken;
    
            return  response()->json([
                'message' => ['User login successfully.'],
                'user' => $sociallogin,
                'token' => $token
            ],200);
        }
     


    }
}
