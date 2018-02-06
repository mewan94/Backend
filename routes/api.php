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
Route::group(['namespace' => 'Todo', 'prefix' => '/todos','middleware' => ['auth:api']],function (){
    Route::get('/',['as' => 'todos', 'uses'=>'TodoController@index']);
    Route::post('/save',['as' => 'todos', 'uses'=>'TodoController@create']);
    Route::post('/update',['as' => 'todos', 'uses'=>'TodoController@update']);
    Route::post('/delete',['as' => 'todos', 'uses'=>'TodoController@delete']);
    Route::post('/check',['as' => 'todos', 'uses'=>'TodoController@check']);
    Route::post('/uncheck',['as' => 'todos', 'uses'=>'TodoController@uncheck']);
});