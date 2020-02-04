<?php namespace App\Http\Controllers\Store;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\shop;
use App\Models\chain;

class ChainsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function addchain(Request $request)
    {

        $shop_owner = AuthController::me();
        $store_id=$shop_owner->shop()->value('id');
        $chain= new chain();
        $chain->chain_name = $request->input('chain_name');
        $chain->store_id = $store_id;
        $chain->adress = $request->input('adress');
        $chain->contacter = $request->input('contacter');
        $chain->chain_mobile = $request->input('chain_mobile');
        $chain->chain_telephone = $request->input('chain_telephone');
        $chain->chain_opening_hours = $request->input('chain_opening_hours');
        $chain->chain_close_hours = $request->input('chain_close_hours');
        $chain->chain_trafic_line = $request->input('chain_trafic_line'); 
        $chain->chain_lng = $request->input('chain_lng');
        $chain->chain_lat = $request->input('chain_lat');
        $chain->approved = $request->input('approved');
        $chain->chain_ip = $request->input('chain_ip');
        $chain->chain_district_id = $request->input('chain_district_id');
        $chain->chain_district_info = $request->input('chain_district_info');
        // if ($request->hasFile('store_logo')) {
            //     $path = $request->file('chain_img')->store('chains', 'google');
            //     $fileUrl = Storage::url($path);
            //     $product->chain_img = $fileUrl;
            // }
        $chain->shop_owner_id=$shop_owner->id;
        
        if( $chain->save())
        {
            return response()->json(['msg' => 'Chain has been added'], 200);
        }
        return response()->json(['msg' => 'Error while saving'], 500);
        
    }

    public function assignManagerToChain(Request $request)
    {
        $shop_owner = AuthController::me();
        $managerId = $request->input('manager_id');
        $chain_id= $request->input('chain_id');
        $manager = User::where('id', $managerId)->first();
        $chain=chain::find($chain_id);
        $chain->manager_id=$managerId;
        $chain->save();
        return  response()->json(["msg" => "Manager has been affected to chain"], 200);
    }


    public function assignCachierToChain(Request $request)
    {
        $shop_owner = AuthController::me();
        $cachier_id = $request->input('cachier_id');
        $chain_id= $request->input('chain_id');
        $cachier= User::where('id', $cachier_id)->first();
        $cachier->chain_id=$chain_id;
        $cachier->save();
        return  response()->json(["msg" => "cachier has been affected to chain"], 200);
    }

    public function getChainList(Request $request)
    {
        $shop_owner = AuthController::me();
        $store_id=$request->input('store_id');
        $store= shop::find($store_id);
        $chainList = $store->chains()->get();

        $response = array();
        $response['msg']="";
        $response['code']=1;
        $response['data']=$chainList;
        return response()->json($response);
    }

    public function getChain(Request $request)
    {
        $shop_owner = AuthController::me();
        $store_id=$request->input('store_id');
        $chain_id=$request->input('chain_id');
        $store= shop::find($store_id);
        $chain =chain::find($chain_id);

        $response = array();
        $response['msg']="";
        $response['code']=1;
        $response['data']=$chain;
        return response()->json($response);
    }






}
