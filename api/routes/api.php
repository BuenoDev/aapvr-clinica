<?php

use Illuminate\Http\Request;

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
Route::group(['prefix' => 'register'], function () {
    Route::post('/','RegisterUserController@store');
});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/user', 'UserController@index');
    Route::delete('/user/{user}/role','UserController@revoke');
    Route::put('/user/{user}/role','UserController@syncRoles');
    Route::put('/user/{user}/permission','UserController@syncPermissions');
    Route::get('/role','RoleController@index');
    Route::post('/role','RoleController@store');
    Route::get('/permission','PermissionController@index');
});
