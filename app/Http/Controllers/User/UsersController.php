<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller {


    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function getManagersList(Request $request)
    {
        $shop_owner = AuthController::me();
        $managerList=$shop_owner->ShopOwnerManager()->get();
        return response()->json($managerList, 200);

    }
    public function getCachiersList(Request $request)
    {
        $shop_owner = AuthController::me();
        $cachierList=$shop_owner->ShopOwnerCachier()->get();
        return response()->json($cachierList, 200);

    }

    public function getManagerByEmail(Request $request)
    {
        $email = $request->input('email');
        $Manager = User::where('email', $email)
            ->whereHas('role', function ($query) {
                $query->where('name', 'ShopManager')->distinct();
            })->get();
        return response()->json($Manager, 200);
    }

    public function getCachierByEmail(Request $request)
    {
        $email = $request->input('email');
        // $shopsIds = $request->input('shopsIds');
        $cachier = User::where('email', $email)
            ->whereHas('role', function ($query) {
                $query->where('name', 'cachier')->distinct();
            })->get();
        return response()->json($cachier, 200);
    }

}
