<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class SignUpsController extends Controller {


    public function addShopOwner(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $user = new User();
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $role = Role::where('name', 'ShopOwner')->first();
        $role->users()->save($user);
        $user->save();
        return response()->json(["msg" => "user added successfully !"], 200);

        return response()->json(["msg" => "ERROR !"], 500);
    }

    public function addShopManager(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $shop_owner = AuthController::me();
        $user = new User();
        $user ->shop_owner_id=$shop_owner->id;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->activated_account=1;
        $user->password = Hash::make($password);
        $role = Role::where('name', 'ShopManager')->first();
        $role->users()->save($user);
        $user->save();
        return response()->json(["msg" => "user added successfully !"], 200);

        return response()->json(["msg" => "ERROR !"], 500);
    }

    
    public function addCachier(Request $request)
    {
        
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $shop_owner = AuthController::me();
        $user = new User();
        $user ->shop_owner_id=$shop_owner->id;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->activated_account=1;
        $user->password = Hash::make($password);
        $role = Role::where('name', 'cachier')->first();
        $role->users()->save($user);
        $user->save();
        return response()->json(["msg" => "user added successfully !"], 200);

        return response()->json(["msg" => "ERROR !"], 500);
    }

}
