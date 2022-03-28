<?php

// GENERAL ROUTES
Route::group(['prefix' => 'content', 'middleware' => []], function () {
    Route::get('/slider', 'SliderController@actionSliderIndex')->name('actionSliderIndex');
    Route::get('/banners', 'SliderController@actionBannerIndex')->name('actionBannerIndex');
});

// AJAX ROUTES
Route::group(['prefix' => 'contents/ajax', 'middleware' => []], function () {
    
});