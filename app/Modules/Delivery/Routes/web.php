<?php

// GENERAL ROUTES
Route::group(['prefix' => 'delivery', 'middleware' => []], function () {
    Route::get('/parameters', 'DeliveryController@actionDeliveryParameters')->name('actionDeliveryParameters');
    Route::get('/address', 'DeliveryController@actionDeliveryAddress')->name('actionDeliveryAddress');
});

// AJAX ROUTES
Route::group(['prefix' => 'delivery/ajax', 'middleware' => []], function () {
    Route::get('/streets', 'DeliveryAjaxController@ajaxGetDeliveryStreets')->name('ajaxGetDeliveryStreets');
    Route::post('/streets/active', 'DeliveryAjaxController@ajaxDeliveryStreetsActive')->name('ajaxDeliveryStreetsActive');
    Route::post('/district/price', 'DeliveryAjaxController@ajaxUpdateDeliveryPrice')->name('ajaxUpdateDeliveryPrice');
    Route::post('/district/active', 'DeliveryAjaxController@ajaxDeliveryDistrictActive')->name('ajaxDeliveryDistrictActive');
});