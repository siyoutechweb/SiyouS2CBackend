<?php namespace App\Http\Controllers\Products;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
class GetProductsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getProductsList(request $request)
    {
        $category_id = $request->input('category_id');
        $supplier_id = $request->input('supplier_id');
        $barcode = $request->input('barcode');
        $shop_Owner = AuthController::me();

        if ($request->filled('barcode')) {
            $productsList = $shop_Owner->products()->where('product_barcode', $barcode)
            ->simplePaginate();
        }
        elseif ($request->filled('supplier_id','category_id'))
        {
            $productsList = $shop_Owner->products()
            ->where([["category_id",$category_id],["supplier_id",$supplier_id]])
            ->simplePaginate();
        } 
      
        elseif ($request->filled('category_id')) {
            $productsList = $shop_Owner->products()
            ->where('category_id', $category_id)->simplePaginate();
        }
        elseif ($request->filled('supplier_id')) {
            $productsList = $shop_Owner->products()
            ->where('supplier_id', $supplier_id)->simplePaginate();
        }
        else 
        { $productsList = $shop_Owner->products()->simplePaginate();}
        
        $response = array();
        $response['code']=1;
        $response['msg']='';
        $response['data']= $productsList;
        
        return response()->json($response, 200);
    }




    public function getProduct(Request $request)
    {
        $shop_Owner = AuthController::me();
        $barcode=$request->input('item_barcode');
        $product = $shop_Owner->products()->where('product_barcode',$barcode)->get();
        
        if ($product!=[]) {
            $response = array();
            $response['code']=1;
            $response['msg']='';
            $response['data']=$product;
            return response()->json($response);
        }
        $response = array();
        $response['code']=0;
        $response['msg']='1';
        $response['data']='product does not exist';
        return response()->json($response); 
    }

    public function generateBarcode()
    {
        $shop_Owner = AuthController::me();
        $new_barcode = rand(pow(10, 12) - 1, pow(10, 13) - 1);
        $products = $shop_Owner->products()->pluck('product_barcode')->toArray();
       
            while (in_array($new_barcode , $products, true)) 
            {
                $new_barcode = rand(pow(10, 12) - 1, pow(10, 13) - 1);
            }
        
            $response = array();
            $response['code'] = 1 ;
            $response['msg'] = "";
            $response['data'] = $new_barcode;
            return response()->json($response); 

    }
 




}
