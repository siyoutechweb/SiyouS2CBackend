<?php namespace App\Http\Controllers\Store;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\shop;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function createShop(Request $request)
    {
        $shop_owner = AuthController::me();
        $shop=$shop_owner->shop()->get();
        if ($shop==[]) {
        $shop= new shop();
        $shop->store_name = $request->input('store_name');
        $shop->store_name_en = $request->input('store_name_en');
        $shop->store_name_it = $request->input('store_name_it');
        $shop->store_area = $request->input('store_area');
        $shop->store_domain = $request->input('store_domain');
        $shop->store_adress = $request->input('store_adress');
        $shop->contact = $request->input('contact');
        $shop->store_longitude = $request->input('store_longitude'); 
        $shop->store_latitude = $request->input('store_latitude');
        $shop->opening_hour = $request->input('opening_hour');
        $shop->closure_hour = $request->input('closure_hour');
        $shop->store_ip = $request->input('store_ip');
        $shop->store_is_selfsupport = $request->input('store_is_selfsupport');
        $shop->shop_owner_id = $shop_owner->id;
        // if ($request->hasFile('store_logo')) {
            //     $path = $request->file('store_logo')->store('logos', 'public');
            //     $fileUrl = Storage::url($path);
            //     $product->store_logo = $fileUrl;
            // }
        
        if($shop->save())
        {
            return response()->json(['msg' => 'Store has been added'], 200);
        }
        return response()->json(['msg' => 'Error while saving'], 500);
    }
    return response()->json(['msg' => 'Shop Owner has a store'], 500);
        
    }


    public function getStore(Request $request)
    {
        $shop_owner = AuthController::me();
        $store_id=$request->input('store_id');
        $store= shop::find($shop_owner);

        $response = array();
        $response['msg']="";
        $response['code']=1;
        $response['data']=$store;
        return response()->json($response);
    }



    

    // public function updatechain(Request $request, $chain_id)
    // {
    //     $name=$request->input('name');
    //     $adress=$request->input('adress');
    //     $contact=$request->input('contact');
    //     $opening_hour=$request->input('opening_hour');
    //     $closure_hour=$request->input('closure_hour');
    //     $chain=chain::find($chain_id);
    //     $chain->name=$name;
    //     $chain->adress=$adress;
    //     $chain->contact=$contact;
    //     $chain->opening_hour=$opening_hour;
    //     $chain->closure_hour=$closure_hour;
    //     $chain->save();
    //     return response()->json(['msg' => 'Shop has been added'], 200);
    // }


}
