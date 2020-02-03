<?php namespace App\Http\Controllers\Store;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\shop;

class ShopsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function createShop(Request $request)
    {
        $name=$request->input('name');
        $adress=$request->input('adress');
        $contact=$request->input('contact');
        $tax=$request->input('tax');
        $opening_hour=$request->input('opening_hour');
        $closure_hour=$request->input('closure_hour');
        $shop_owner = AuthController::me();
        $shop=$shop_owner->shop()->get();
        if ($shop==[]) {
            $shop= new shop(); 
            $shop->name=$name;
            $shop->adress=$adress;
            $shop->contact=$contact;
            $shop->tax_identification=$tax;
            $shop->opening_hour=$opening_hour;
            $shop->closure_hour=$closure_hour;
            $shop->shop_owner_id=$shop_owner->id;
            if($shop->save())
            {
                return response()->json(['msg' => 'Store has been added'], 200);
            }
            return response()->json(['msg' => 'Error while saving'], 500);
        }
        return response()->json(['msg' => 'Shop Owner has a store'], 500);
        
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
