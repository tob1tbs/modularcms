<?php

// GENERAL ROUTES
Route::group(['prefix' => 'content', 'middleware' => ['login']], function () {
    Route::get('/slider', 'SliderController@actionSliderIndex')->name('actionSliderIndex');
});

// AJAX ROUTES
Route::group(['prefix' => 'content/ajax', 'middleware' => []], function () {
    Route::post('/slider/upload', 'SliderAjaxController@ajaxSliderUploadPhoto')->name('ajaxSliderUploadPhoto');
    Route::get('/slider/view', 'SliderAjaxController@ajaxSliderViewPhoto')->name('ajaxSliderViewPhoto');
    Route::post('/slider/delete', 'SliderAjaxController@ajaxSliderDeletePhoto')->name('ajaxSliderDeletePhoto');
});