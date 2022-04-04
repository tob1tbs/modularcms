<?php

// GENERAL ROUTES
Route::group(['prefix' => 'services', 'middleware' => ['login']], function () {
    Route::get('/', 'actionServicesController@ServicesIndex')->name('actionServicesIndex');
});

// AJAX ROUTES
Route::group(['prefix' => 'services/ajax', 'middleware' => []], function () {
    
});