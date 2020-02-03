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
        $name=$request->input('name');
        $adress=$request->input('adress');
        $contact=$request->input('contact');
        $opening_hour=$request->input('opening_hour');
        $closure_hour=$request->input('closure_hour');

        $shop_owner = AuthController::me();
        $shop_id=$shop_owner->shop()->value('id');
     
        $chain= new chain();
        $chain->name=$name;
        $chain->adress=$adress;
        $chain->contact=$contact;
        $chain->opening_hour=$opening_hour;
        $chain->closure_hour=$closure_hour;
        $chain->shop_owner_id=$shop_owner->id;
        $chain->shop_id=$shop_id;
        $chain->save();
        return response()->json(['msg' => 'Chain has been added'], 200);
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
        $chain=chain::with('cachiers','manager')->where('shop_Owner_id',$shop_owner->id)->get();
      
        return  response()->json($chain, 200);
    }



}
