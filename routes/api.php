<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Products;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/recommendation/{city}', 'ProductsController@show');
Route::post('products/recommendation', function () {
    $city = request('city');
    return Redirect::action('ProductsController@show', array('city' => $city));
});

Route::get('products', function () {
    return Products::all();
});
