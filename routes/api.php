<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('unauthenticated', 'UserController@unauthenticated')->name('unauthenticated'); //Вот просто на это полтора дня потратил.. В итоге решил сделать так.. Но тут явно что-то не так .-.

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('departments', 'DepartmentController');

    Route::get('workers', 'WorkerController@all');
    Route::get('workers/{id}', 'WorkerController@worker');

    Route::get('user', 'UserController@read');
    Route::post('user', 'UserController@update');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController');
        Route::post('login', 'LoginController');
        Route::post('restore', 'PasswordResetController@create');
        Route::post('restore/confirm', 'PasswordResetController@confirm');
    });
});

//Обожаю Python за то, что не пришлось скачивать сторонние приложения для того, чтобы кидаться запросами к этой апишке :D