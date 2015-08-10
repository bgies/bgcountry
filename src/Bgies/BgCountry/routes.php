<?php

/* Routes to get the Form */
Route::get('bgcountry/form', ['as' => 'bgcountry.defaultform', 'uses' => 'bgies\BgCountry\BgCountryController@getDefaultForm']);
Route::post('bgcountry/multi', ['as' => 'bgcountry.mulitform', 'uses' => 'bgies\BgCountry\BgCountryController@getMultiLanguageForm']);

/* Routes To get select list via AJAX for Single Language */
Route::any('bgcountry/default', ['as' => 'bgcountry.default', 'uses' => 'bgies\BgCountry\BgCountryController@getCountries']);
Route::any('bgprovince/default', ['as' => 'bgprovince.default', 'uses' => 'bgies\BgCountry\BgCountryController@getProvince']);
Route::any('bgcity/default', ['as' => 'bgcity.default', 'uses' => 'bgies\BgCountry\BgCountryController@getCity']);
/* Routes To get select list via AJAX for Multi Language */
Route::any('bgcountry/{locale}', ['as' => 'bgcountry.locale', 'uses' => 'bgies\BgCountry\BgCountryController@getCountryMulti']);
Route::any('bgprovince/{locale}', ['as' => 'bgprovince.locale', 'uses' => 'bgies\BgCountry\BgCountryController@getProvinceMulti']);
Route::any('bgcity/{locale}', ['as' => 'bgcity.locale', 'uses' => 'bgies\BgCountry\BgCountryController@getCityMulti']);


Route::get('bgcountry/migration', 'bgies\BgCountry\BgCountryController@createMigration');

Route::get('bgcountry/admin', 'bgies\BgCountry\BgCountryController@getAdmin');