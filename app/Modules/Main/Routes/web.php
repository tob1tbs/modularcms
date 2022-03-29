<?php

// GENERAL ROUTES
Route::group(['prefix' => '/', 'middleware' => ['login']], function () {
	Route::get('/', 'MainController@actionMainIndex')->name('actionMainIndex');
	Route::get('/link', function () {        
	   $target = '/home/public_html/storage/app/public';
	   $shortcut = '/home/public_html/public/storage';
	   symlink($target, $shortcut);
	});
});

Route::group(['prefix' => '/main/ajax/', 'middleware' => []], function () {
	Route::get('/notification/view', 'MainAjaxController@ajaxViewNotification')->name('ajaxViewNotification');

});