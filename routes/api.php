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

// without token
Route::post('/register', 'AuthController@create');
Route::post('/login', 'AuthController@login');
Route::post('/data-fill', 'DataFillController@fill')->name('data.fill');

// with token
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/customers', 'CustomersController@getCustomers')->name('customers.get');
    Route::put('/user/{id}', 'UsersController@edit')->name('users.edit');
    Route::get('/nodes', 'NodesController@getNodes')->name('nodes.get');
    Route::get('/nodes-statistic/{id}', 'NodesController@getStatistic')->name('nodes.statistic');
    Route::post('/nodes', 'NodesController@create')->name('nodes.create');
    Route::put('/nodes/{id}', 'NodesController@update')->name('nodes.create');
    Route::delete('/nodes/{id}', 'NodesController@remove')->name('nodes.remove');
    Route::get('/node-types', 'NodesController@getTypes')->name('nodes.getTypes');
    Route::get('/sensors', 'SensorsController@getSensors')->name('sensors.get');
    Route::get('/sensors/{id}', 'SensorsController@getSensor')->name('sensors.view');
    Route::post('/sensors', 'SensorsController@create')->name('sensors.create');
    Route::get('/statistic', 'StatisticController@getStatistic')->name('statistic.get');
    Route::post('/sensor-settings', 'SensorSettingsController@createOrUpdate')->name('settings.createOrUpdate');
    Route::get('/last-data/{id}', 'NodesController@getLastData')->name('nodes.lastData');
});
