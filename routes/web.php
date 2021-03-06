<?php

use App\Http\Controllers\HelperController;
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
    return view('index');
});

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('public/vehicle/{id}/{filename}', function ($id, $filename)
{
    $path = storage_path("app/public/vehicle/{$id}/{$filename}");
    return  HelperController::downloadImage($path); 
});

Route::get('public/avatars/{filename}', function ($filename)
{
    $path = storage_path("app/public/avatars/{$filename}");
    return  HelperController::downloadImage($path); 
});

Route::get('public/parking/{id}/{filename}', function ($id, $filename)
{
    $path = storage_path("app/public/parking/{$id}/{$filename}");
    return  HelperController::downloadImage($path); 
});


