<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('blades.home');
});

// Route::get('/products', function() {
// 	$client = new Client();

// 	$response = $client->request('GET', 'https://api.meteo.lt/v1/places/vilnius/forecasts');
// 	$statusCode = $response->getStatusCode();
// 	$body = $response->getBody()->getContents();

// 	return $body;
// });