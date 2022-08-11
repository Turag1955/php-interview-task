<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => '/'], function () {
    Route::get('/', 'StoreReportController@index')->name('/');
    Route::post('store-report', 'StoreReportController@store')->name('store.report');
});

Route::group(['prefix' => 'workspace', 'as' => 'workspace.'], function () {
    Route::get('/', 'WorkspaceController@index')->name('index');
    Route::post('store', 'WorkspaceController@store')->name('store');
});

Route::group(['prefix' => 'board', 'as' => 'board.'], function () {
    Route::get('/{id}', 'BoardController@index')->name('index');
    Route::post('store', 'BoardController@store')->name('store');
    Route::post('edit', 'BoardController@edit')->name('edit');
    Route::put('update', 'BoardController@update')->name('update');
    Route::post('delete', 'BoardController@delete')->name('delete');
});

Route::group(['prefix' => 'trello', 'as' => 'trello.'], function () {
    Route::get('/', 'SettingController@index')->name('setting');
    Route::post('store', 'SettingController@trelloSettingUpdate')->name('store');
});
