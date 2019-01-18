<?php

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

Route::get('/', function () {
   return 'Silence is golden';
});
\Illuminate\Support\Facades\Auth::routes();

Route::post('/data-fill', 'DataFillController@fill')->name('data.fill');

// with token
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/get-users', 'UsersController@getUsers')->name('users.get');

});
