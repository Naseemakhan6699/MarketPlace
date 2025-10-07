<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Accountdetail;
use Illuminate\Http\Request;

class ApiAccountdetailController extends Controller
{
    public function store(Request $request)
  {
   
    if(!auth('sanctum')->check()){
        return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
    }

    $user = auth('sanctum')->user();
    $accountdetail=new Accountdetail();
  
    $accountdetail->user_id=$request->user_id;
    $accountdetail->user_prefrence_id=$request->user_prefrence_id;
    // $accountdetail->document_id=$request->document_id;
    $accountdetail->location=$request->location;
    $accountdetail->save();  
    if(!$accountdetail)
        {
          return response()->json([
            'status'=>202,
            'message'=>'accountdetail not found',
            'accountdetail'=>$accountdetail
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'accountdetail found',
                'accountdetail'=>$accountdetail
              ]);
        }  
  }
    public function get(Request $request)
  {
   
    if(!auth('sanctum')->check()){
        return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
    }

    $user = auth('sanctum')->user();
    $accountdetail=Accountdetail::with('user','document')->get();
 
    if(!$accountdetail)
        {
          return response()->json([
            'status'=>202,
            'message'=>'accountdetail not found',
            'accountdetail'=>$accountdetail
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'accountdetail found',
                'accountdetail'=>$accountdetail
              ]);
        }  
  }
}
