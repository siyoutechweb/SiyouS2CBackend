<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addProduct(Request $request)
    {
        $shop_owner = AuthController::me();
        $shop_id= $shop_owner->shop()->value('id');
        if ($request->filled('product_name','product_barcode','unit_price',
        'cost_price','tax_rate','product_quantity','category_id')) 
        {
            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_barcode = $request->input('product_barcode');
            $product->product_description = $request->input('product_description');
            $product->unit_price = $request->input('unit_price');
            $product->cost_price = $request->input('cost_price');
            $product->member_price = $request->input('member_price');
            $product->member_point = $request->input('member_point');
            $product->tax_rate = $request->input('tax_rate');
            $product->product_quantity = $request->input('product_quantity');
            $product->warm_quantity = $request->input('warm_quantity');
            $product->product_weight = $request->input('product_weight');
            $product->product_size = $request->input('product_size');
            $product->product_color = $request->input('product_color');
            $product->supplier_id = $request->input('supplier_id');
            $product->category_id = $request->input('category_id');
            $product->shop_owner_id= $shop_owner->id;
            $product->shop_id= $shop_id;
            $product->product_image='product image';
            // if ($request->hasFile('product_image')) {
            //     $path = $request->file('product_image')->store('products', 'google');
            //     $fileUrl = Storage::url($path);
            //     $product->product_image = $fileUrl;
            // }

            if ($product->save()) {
                $response = array();
                $response['code']=1;
                $response['msg']='';
                $response['data']=$product;
                return response()->json($response);
            }
            $response = array();
            $response['code']=0;
            $response['msg']='3';
            $response['data']='error while saving';
            return response()->json($response);
        }
        $response = array();
        $response['code']=0;
        $response['msg']='1';
        $response['data']='parameters missing, in data field';
        return response()->json($response);   
    }


    
    public function updateProduct(Request $request, $id)
    {
        $shop_owner = AuthController::me();
        $product = Product::findorfail($id);
        $product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->quantity = $request->input('quantity');
        $product->unit_price = $request->input('product_price');
         $product->unit_price = $request->input('product_price');
        $product->product_weight = $request->input('product_weight');
        $product->product_size = $request->input('product_size');
        $product->product_color = $request->input('product_color');
        $product->product_barcode = $request->input('product_barcode');
        $product->category_id = $request->input('category_id');
        $product->shop_owner_id = $shop_owner->id;
        // if ($request->hasFile('product_image')) {
        //     $path = $request->file('product_image')->store('products', 'google');
        //     $fileUrl = Storage::url($path);
        //     $product->product_image = $fileUrl;
        // }
        if ($product->save()) {
            return response()->json($product);
        }
        return response()->json(["msg" => "ERROR !!"]);
    }

    public function deleteProduct(Request $request)
    {
        $barcode=$request->input('barcode');
        $product = Product::where('product_barcode',$barcode)->get();
        $product->delete();
        return response()->json(["msg" => "the Product has been deleted Successfully !!"]);
    }





   

   
}

