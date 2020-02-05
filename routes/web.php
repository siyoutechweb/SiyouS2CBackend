<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->get('/key', function () {
//     return \Illuminate\Support\Str::random(32);
// });

// ShopOwner Routes 

$router->post('/SignUp', ['uses' => 'User\SignUpsController@addShopOwner']);
$router->post('/Store', ['uses' => 'store\ShopsController@createShop']);
$router->post('/login', ['uses' => 'AuthController@login']);

$router->post('/addManager', ['uses' => 'User\SignUpsController@addShopManager']);
$router->post('/addCachier', ['uses' => 'User\SignUpsController@addCachier']);
$router->get('/ManagersList', ['uses' => 'User\UsersController@getManagersList']);
$router->get('/CachiersList', ['uses' => 'User\UsersController@getCachiersList']);
$router->get('/Manager', ['uses' => 'User\UsersController@getManagerByEmail']);
$router->get('/Cachier', ['uses' => 'User\UsersController@getCachierByEmail']);
$router->get('/Store', ['uses' => 'Store\ShopsController@getStore']);

$router->group(['prefix' => 'Chain','middleware' => 'role:ShopOwner'], function () use ($router) {
    $router->post('/', ['uses' => 'Store\ShopsController@addChain']);
    $router->get('/List', ['uses' => 'Store\ChainsController@getChainList']);
    $router->get('/', ['uses' => 'Store\ChainsController@getChain']);
    $router->put('/Manager', ['uses' => 'Store\ChainsController@assignManagerToChain']);
    $router->put('/Cachier', ['uses' => 'Store\ChainsController@assignCachierToChain']);
});        

$router->group(['prefix' => 'Product','middleware' => 'role:ShopOwner'], function () use ($router) {
    $router->post('/', ['uses' => 'Products\ProductsController@addProduct']);
    $router->put('/', ['uses' => 'Products\ProductsController@updateProduct']);
    $router->get('/List', ['uses' => 'Products\GetProductsController@getProductsList']);
    $router->get('/', ['uses' => 'Products\GetProductsController@getProduct']);
    $router->get('/Barcode', ['uses' => 'Products\GetProductsController@generateBarcode']);
    $router->delete('/', ['uses' => 'Products\ProductsController@deleteProduct']);
});

    


// Admin Routes

$router->group(['prefix' => 'Admin','middleware' => 'role:SuperAdmin'], function () use ($router) {

    $router->group(['prefix' => 'Accounts'], function () use ($router) {
    $router->get('/', ['uses' => 'Admin\AccountsController@getInactiveAccount']);
    $router->put('/{user_id}', ['uses' => 'Admin\AccountsController@activeAccount']);
    });
   
    $router->group(['prefix' => 'Categories'], function () use ($router) {
        $router->post('/', ['uses' => 'Admin\CategoriesController@addCategory']);
        $router->get('/', ['uses' => 'Admin\CategoriesController@getCategories']);
        $router->put('/', ['uses' => 'Admin\CategoriesController@updateCategory']);
        $router->get('/{id}', ['uses' => 'Admin\CategoriesController@getCategorieById']);
        $router->Delete('/{id}', ['uses' => 'Admin\CategoriesController@deleteCategory']);
    });
    

});





<<<<<<< HEAD

=======
>>>>>>> 257b016f0582a87fd36f6b1b65db5bfc7c79a98a
