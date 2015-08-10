<?php

/* Routes to get the Form */
Route::get('bgcountry/default', 'bgies\BgCountry\BgCountryController@getDefaultForm');
Route::post('bgcountry/multi', 'bgies\BgCountry\BgCountryController@getMultiLanguageForm');

/* Routes for Single Language */
Route::post('country/default', 'bgies\BgCountry\BgCountryController@getCountry');
Route::post('province/default', 'bgies\BgCountry\BgCountryController@getProvince');
Route::post('city/default', 'bgies\BgCountry\BgCountryController@getCity');
/* Routes for Multi Language */
Route::post('country/{locale}', 'bgies\BgCountry\BgCountryController@getCountryMulti');
Route::post('province/{locale}', 'bgies\BgCountry\BgCountryController@getProvinceMulti');
Route::post('city/{locale}', 'bgies\BgCountry\BgCountryController@getCityMulti');


Route::get('bgcountry/migration', 'bgies\BgCountry\BgCountryController@createMigration');

Route::get('bgcountry/admin', 'bgies\BgCountry\BgCountryController@getAdmin');