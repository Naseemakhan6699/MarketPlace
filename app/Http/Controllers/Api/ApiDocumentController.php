<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class ApiDocumentController extends Controller
{
  public function store(Request $request)
  {
   
    if(!auth('sanctum')->check()){
        return response()->json(['status' => 422, 'message' => "You are not authorized to access this route"]);
    }

    $user = auth('sanctum')->user();
    $document=new Document();
    if ($request->file('image')) {
        $file = $request->file('image');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('/storage/document/'), $filename);
        $document['image'] = $filename;
    }
    $document->name=$request->name;
    $document->user_id=$user->id;
    $document->save();  
    if(!$document)
        {
          return response()->json([
            'status'=>202,
            'message'=>'Document not found',
            'Document'=>$document
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'Document found',
                'Document'=>$document
              ]);
        }  
  }
}
