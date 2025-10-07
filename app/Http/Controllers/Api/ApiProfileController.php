<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiProfileController extends Controller
{
    public function get()
    {
        if(!auth('sanctum')->check()){
            return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
        }

        $user = auth('sanctum')->user();
        
        if(!$user)
        {
          return response()->json([
            'status'=>202,
            'message'=>'profile not found',
            'profile'=>$user
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'profile found',
                'profile'=>$user
              ]);
        }
    }
    public function update(Request $request)
    {
      if(!auth('sanctum')->check()){
        return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
    }

    $user = auth('sanctum')->user();
    $input=$request->all();
    if ($request->file('image')) {
      $file = $request->file('image');
      $filename = date('YmdHi') . $file->getClientOriginalName();
      $file->move(public_path('/storage/profile/'), $filename);
      $input['image'] = $filename;
  }
    User::where('id',$user->id)->update($input);
    if(!$user)
    {
      return response()->json([
        'status'=>202,
        'message'=>'profile not found',
        'profile'=>$user
      ]);
    }
    else
    {
        return response()->json([
            'status'=>200,
            'message'=>'profile found',
            'profile'=>$user
          ]);
    }
    }
}
