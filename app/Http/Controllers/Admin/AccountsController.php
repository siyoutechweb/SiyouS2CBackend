<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getInactiveAccount(Request $request)
    {
        $InactiveAccount = user::where('activated_Account', 0)->get();
        return response()->json($InactiveAccount, 200);
    }


    public function activeAccount(Request $request,$user_id)
    {
        return $request;
        $shop=user::find($user_id);
        $shop->activated_account=1;
        $shop->save();
        return response()->json(['msg' => 'Shop Owner account has been activated'], 200);
    }
    
}
