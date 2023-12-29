<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/sone-content', 'SoneContentController@list')->name('cms.sone.content.list')->middleware('access:cms.sone.content.list');
    Route::get('/sone-content/add', 'SoneContentController@add')->name('cms.sone.content.add')->middleware('access:cms.sone.content.add');
    Route::post('/sone-content/add', 'SoneContentController@save')->name('cms.sone.content.save')->middleware('access:cms.sone.content.save');
    Route::get('/sone-content/edit/{slug}', 'SoneContentController@edit')->name('cms.sone.content.edit')->middleware('access:cms.sone.content.edit');
    Route::post('/sone-content/edit/{id}', 'SoneContentController@update')->name('cms.sone.content.update')->middleware('access:cms.sone.content.update');
    Route::get('/sone-content/delete/{slug}', 'SoneContentController@delete')->name('cms.sone.content.delete')->middleware('access:cms.sone.content.delete');
    Route::any('/sone-content/search', 'SoneContentController@search')->name('cms.sone.content.search')->middleware('access:cms.sone.content.search');
    Route::get('/sone-content/status/{id}/{type}', 'SoneContentController@status')->name('cms.sone.content.status')->middleware('access:cms.sone.content.status');

    Route::get('/soneContent/add', 'SoneContentController@addContent')->name('cms.sone.content.addContent')->middleware('access:cms.sonecontent.addContent');
    Route::post('/soneContent/save', 'SoneContentController@save')->name('cms.sone.content.saveContent')->middleware('access:cms.sonecontent.saveContent');
    Route::get('/soneContent', 'SoneContentController@list')->name('cms.sone.content.listContent')->middleware('access:cms.sonecontent.listContent');
});