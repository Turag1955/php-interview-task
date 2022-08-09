<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;






//Store Report 
Route::get('store-report', 'StoreReportController@index')->name('store.report');
// Route::get('get-category', 'CategoryController@getCategory')->name('category.get-category');


Route::get('report', 'HomeController@index')->name('report');

Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
    Route::get('sms', 'SettingController@smsSetting')->name('sms');
    Route::post('sms', 'SettingController@smsSettingUpdate')->name('sms-update');
});



