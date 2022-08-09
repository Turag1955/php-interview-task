<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', 'StoreReportController@index')->name('/');
Route::post('store-report', 'StoreReportController@store')->name('store.report');

Route::group(['prefix' => 'trello', 'as' => 'trello.'], function () {
    Route::get('/', 'SettingController@index')->name('setting');
    Route::post('store', 'SettingController@trelloSettingUpdate')->name('store');
});

Route::group(['prefix' => 'workspace', 'as' => 'workspace.'], function () {
    Route::get('/', 'WorkspaceController@index')->name('index');
    Route::post('store', 'WorkspaceController@store')->name('store');
});



