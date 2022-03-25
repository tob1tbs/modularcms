<?php

// GENERAL ROUTES
Route::group(['prefix' => '/', 'middleware' => ['login']], function () {
	Route::get('/', 'MainController@actionMainIndex')->name('actionMainIndex');
});

Route::group(['prefix' => '/main/ajax/', 'middleware' => []], function () {
	Route::get('/notification/view', 'MainAjaxController@ajaxViewNotification')->name('ajaxViewNotification');

});