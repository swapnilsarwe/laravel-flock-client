<?php
/**
 * Created by PhpStorm.
 * User: swapnils
 * Date: 08/02/18
 * Time: 5:28 PM
 */
Route::group(['prefix' => 'flock-app', 'namespace' => 'SwapnilSarwe\LaravelFlockClient\Controllers'], function () {
    Route::get('/', 'FlockAppController@index');
});
