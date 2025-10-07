<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\Shopproductimage;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function store(Request $request)
    {
        $shopproduct =new ShopProduct();
        $shopproduct->user_id =$request->user_id;
        $shopproduct->category_id =$request->category_id;
        $shopproduct->product_title =$request->product_title;
        $shopproduct->product_price =$request->product_price;
        $shopproduct->size =$request->size;
        $shopproduct->color =$request->color;
        $shopproduct->description =$request->description;
        // $shopproduct->thumbnail_image =$request->thumbnail_image;
        if ($request->file('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/storage/product/'), $filename);
            $shopproduct['thumbnail_image'] = $filename;
        }
        $shopproduct->save();
        foreach($request->product_image as $product_image)
        {
            $shopproductimages=new Shopproductimage();
            $file = $request->file('product_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/storage/product/'), $filename);
            $shopproductimages['product_image'] = $filename;
            $shopproductimages->shop_product_id =$shopproduct->id;
            $shopproductimages->user_id =$shopproduct->user_id;
            $shopproductimages->product_image =$product_image;
            $shopproductimages->save;
        }
      
       
        if(!$shopproduct)
        {
          return response()->json([
            'status'=>202,
            'message'=>'product not found',
            'product'=>$shopproduct
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'product found',
                'product'=>$shopproduct
              ]);
        }
    }
    public function get(Request $request)
    {
        $shopproduct =ShopProduct::with('product_image')->where('user_id',$request->user_id)->get();
        if(!$shopproduct)
        {
          return response()->json([
            'status'=>202,
            'message'=>'product not found',
            'product'=>$shopproduct
          ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'product found',
                'product'=>$shopproduct
              ]);
        }
    }
}
