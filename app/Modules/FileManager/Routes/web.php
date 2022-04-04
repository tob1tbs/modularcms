<?php

// GENERAL ROUTES
Route::group(['prefix' => 'filemanager', 'middleware' => ['login']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });