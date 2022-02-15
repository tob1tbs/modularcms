<?php

// GENERAL ROUTES
Route::group(['prefix' => 'products', 'middleware' => []], function () {
    Route::get('/', 'ProductsController@actionProductsIndex')->name('actionProductsIndex');
    Route::get('/add', 'ProductsController@actionProductsAdd')->name('actionProductsAdd');
    Route::get('/edit/{product_id}', 'ProductsController@actionProductsEdit')->name('actionProductsEdit');
    Route::get('/categories', 'ProductsController@actionProductsCategories')->name('actionProductsCategories');
    Route::get('/brands', 'ProductsController@actionProductsBrands')->name('actionProductsBrands');
    Route::get('/options', 'ProductsController@actionProductsOptions')->name('actionProductsOptions');
    Route::get('/facebook', 'ProductsController@actionProductsFacebook')->name('actionProductsFacebook');
});

// AJAX ROUTES
Route::group(['prefix' => 'products/ajax', 'middleware' => []], function () {
    // CATEGORIES
    Route::post('/categories/submit', 'ProductAjaxController@ajaxCategoriesAdd')->name('ajaxCategoriesAdd');
    Route::post('/categories/sortable', 'ProductAjaxController@ajaxCategoriesSortable')->name('ajaxCategoriesSortable');
    Route::post('/categories/active', 'ProductAjaxController@ajaxCategoriesActive')->name('ajaxCategoriesActive');
    Route::post('/categories/delete', 'ProductAjaxController@ajaxCategoriesDelete')->name('ajaxCategoriesDelete');
    Route::get('/categories/edit', 'ProductAjaxController@ajaxCategoriesEdit')->name('ajaxCategoriesEdit');
    Route::get('/categories/child', 'ProductAjaxController@ajaxCategoriesChild')->name('ajaxCategoriesChild');
    Route::post('/categories/child/submit', 'ProductAjaxController@ajaxCategoriesChildAdd')->name('ajaxCategoriesChildAdd');
    Route::post('/categories/child/delete', 'ProductAjaxController@ajaxCategoriesChildDelete')->name('ajaxCategoriesChilddelete');
    Route::post('/categories/child/sortable', 'ProductAjaxController@ajaxCategoriesChildSortable')->name('ajaxCategoriesChildSortable');
    Route::get('/get/subcategories', 'ProductAjaxController@ajaxGetSubCategoryList')->name('ajaxGetSubCategoryList');
    Route::get('/get/subcategoriesbrands', 'ProductAjaxController@ajaxGetSubCategoryAndBrandList')->name('ajaxGetSubCategoryAndBrandList');
    Route::get('/get/brandsbysubcategory', 'ProductAjaxController@ajaxGetBrandByChildCategory')->name('ajaxGetBrandByChildCategory');
    // BRANDS
    Route::post('/brands/submit', 'ProductAjaxController@ajaxBrandFormSubmit')->name('ajaxBrandFormSubmit');
    Route::post('/brands/active', 'ProductAjaxController@ajaxBrandActiveChange')->name('ajaxBrandActiveChange');
    Route::post('/brands/delete', 'ProductAjaxController@ajaxBrandDelete')->name('ajaxBrandDelete');
    Route::post('/brands/sortable', 'ProductAjaxController@ajaxBrandSort')->name('ajaxBrandSort');
    Route::get('/brands/edit', 'ProductAjaxController@ajaxBrandEdit')->name('ajaxBrandEdit');
    //OPTIONS
    Route::post('/options/submit', 'ProductAjaxController@ajaxOptionSubmit')->name('ajaxOptionSubmit');
    Route::post('/options/active', 'ProductAjaxController@ajaxOptionActive')->name('ajaxOptionActive');
    Route::get('/options/edit', 'ProductAjaxController@ajaxOptionOptions')->name('ajaxOptionOptions');
    Route::post('/options/delete', 'ProductAjaxController@ajaxOptionDelete')->name('ajaxOptionDelete');
    Route::post('/options/sortable', 'ProductAjaxController@ajaxOptionSortable')->name('ajaxOptionSortable');
    Route::get('/options/value', 'ProductAjaxController@ajaxOptionValue')->name('ajaxOptionValue');
    Route::post('/options/value/submit', 'ProductAjaxController@ajaxOptionValueSubmit')->name('ajaxOptionValueSubmit');
    Route::post('/options/value/active', 'ProductAjaxController@ajaxOptionValueActive')->name('ajaxOptionValueActive');
    Route::post('/options/value/delete', 'ProductAjaxController@ajaxOptionValueDelete')->name('ajaxOptionValueDelete');
    Route::post('/options/value/sortable', 'ProductAjaxController@ajaxOptionValueSortable')->name('ajaxOptionValueSortable');
    Route::get('/options/value/edit', 'ProductAjaxController@ajaxOptionValueEdit')->name('ajaxOptionValueEdit');
    Route::post('/options/value/update', 'ProductAjaxController@ajaxOptionValueUpdate')->name('ajaxOptionValueUpdate');
});