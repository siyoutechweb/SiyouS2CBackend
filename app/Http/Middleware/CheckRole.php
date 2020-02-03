<?php

namespace App\Http\Middleware;

use Closure;
// use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AuthController;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        // if (!$user = JWTAuth::parseToken()->authenticate()) {
        //     return response()->json(['error' => 'User Not Found'], 404);
        // }
        // $actions = $request->route()[1];
        // // list($found, $routeInfo, $params) = $request->route() ?: [false, [], []];
        // // dd($params);
        // // var_dump($request->route()[1]['roles']);
        // // print_r($request->route());
        // $roles = isset($actions['roles']) ? $actions['roles'] : null;
        // if ($user->hasAnyRole($roles) || !$roles) {
        //     return $next($request);
        // }
        // return response()->json(["msg" => "Insufficient permissions"], 401);

        $user = AuthController::me();

        foreach($roles as $role) {
        // Check if user has the role This check will depend on how your roles are set up
        if($user->hasRole($role))
            return $next($request);
        }

        return response()->json(["msg" => "Insufficient permissions"], 401);
    }
}

