<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Category;
use App\Models\Product;
class RopstamApiController extends Controller
{
    public $successStatus = 200;


public function categories(){
      try{
        $categories=Category::all();
    if($categories){
        $res=1;
         $msg="Category list retrieved successfully.";

        $data=$categories;
        $statusCode=200;
    }else{
        $res=0;
        $msg="Category not found.";
        $data=0;
        $statusCode=404;
    }
        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}


public function products(){
      try{
        $products=Product::all();
        $products->makeHidden(['refundable','size']);
    if($products){
        $res=1;
         $msg="Product list retrieved successfully.";

        $data=$products;
        $statusCode=200;
    }else{
        $res=0;
        $msg="Product not found.";
        $data=0;
        $statusCode=404;
    }
        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}



public function productDetails(Request $r){
      try{
         $validator = Validator::make($r->all(), [
            'product_id' => 'required',
        ]);
       if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        

        if(!empty($r->product_id) ){

              $product=Product::where('id',$r->product_id)->first();
if($product){
           
              $res=1;
              $msg="Product retreived successfully!";
              $data=$product;
              $statusCode=200;  

    }else{
               $res=0;
              $msg="Product Id is not correct.";
              $data=0;
              $statusCode=404;
    }


         } else{
                $res=0;
                $msg="Parameter missing!";
                $data=0;
                $statusCode=405;
            }
    if($r->product_id==="0"){
        $res=0;
       $msg="Zero as parameter value is not allowed.";
       $data=0;
       $statusCode=405;
       }

        return  response()->json([
            'success' => $res,
            'message' => $msg,
            'data'=>$data
        ],$statusCode);
}catch(Exception $e){

    echo $e->getMessage();
  return response()->json(['error' => trans('api.something_went_wrong')], 500);

  }
}


}
