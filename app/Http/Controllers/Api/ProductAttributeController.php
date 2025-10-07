<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ShopProduct;
use App\Models\Shoptype;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function color_get()
    {
    
     
        $color=Color::all();
        if(!$color)
        {
          return response()->json([
            'status'=>202,
            'message'=>'color not found',
            'colors'=>$color
          ],202);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'color found',
                'color'=>$color
              ],200);
        }
    
    }
    public function size_get()
    {
    
     
        $size=Size::all();
        if(!$size)
        {
          return response()->json([
            'status'=>202,
            'message'=>'size not found',
            'sizes'=>$size
          ],202);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'size found',
                'size'=>$size
              ],200);
        }
    
    }
    public function shoptype_get()
    {
    
     
        $shoptype=Shoptype::all();
        if(!$shoptype)
        {
          return response()->json([
            'status'=>202,
            'message'=>'shoptype not found',
            'shoptypes'=>$shoptype
          ],202);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'shoptype found',
                'shoptype'=>$shoptype
              ],200);
        }
    
    }
    public function shoptype_product_get(Request $request)
    {
    
     
        $shoptype=ShopProduct::where('shoptype',$request->shop_type_id)->get();
        if(!$shoptype)
        {
          return response()->json([
            'status'=>202,
            'message'=>'shoptype related product not found',
            'shoptypes'=>$shoptype
          ],202);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'shoptype related product found',
                'shoptype'=>$shoptype
              ],200);
        }
    
    }
    public function shoptype_product_dataget(Request $request)
    {
    
     
        $shoptype=ShopProduct::find($request->id);
        if(!$shoptype)
        {
          return response()->json([
            'status'=>202,
            'message'=>'shoptype product not found',
            'shoptypes'=>$shoptype
          ],202);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'message'=>'shoptype product found',
                'shoptype'=>$shoptype
              ],200);
        }
    
    }
}
