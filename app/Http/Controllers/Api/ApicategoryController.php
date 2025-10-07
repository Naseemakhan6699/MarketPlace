<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Userprefrence;
use Illuminate\Http\Request;

class ApicategoryController extends Controller
{
    public function get()
    {
        if(!auth('sanctum')->check()){
            return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
        }

        $user = auth('sanctum')->user();
        $categories=Category::all();
        if(!$categories)
        {
          return response()->json([
            'status'=>202,
            'message'=>'categories not found',
            'categories'=>$categories
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'categories found',
                'categories'=>$categories
              ]);
        }
    }
    public function subcategory_get()
    {
        if(!auth('sanctum')->check()){
            return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
        }

        $user = auth('sanctum')->user();
        $categories=Sub_category::with('category')->get();
        if(!$categories)
        {
          return response()->json([
            'status'=>202,
            'message'=>'categories not found',
            'categories'=>$categories
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'categories found',
                'categories'=>$categories
              ]);
        }
    }
    public function userprefrence()
    {
        if(!auth('sanctum')->check()){
            return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
        }

        $user = auth('sanctum')->user();
        $categories=Userprefrence::get();
        if(!$categories)
        {
          return response()->json([
            'status'=>202,
            'message'=>'User prefrence not found',
            'userprefrence'=>$categories
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'User prefrence found',
                'userprefrence'=>$categories
              ]);
        }
    }
}
