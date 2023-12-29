<?php

use Illuminate\Support\Facades\Route;

Route::get('/su/login', 'AuthController@login')->name('login');
Route::post('/su/login', 'AuthController@validateLogin');
Route::get('/su/forgot-password', 'AuthController@forgotPassword')->middleware('guest')->name('reset.request');
Route::post('/su/reset-password', 'AuthController@resetPasswordLink')->middleware('guest')->name('reset.resetlink');
Route::get('/su/user-reset-password/{token}', 'AuthController@showResetPasswordForm')->name('reset.password');
Route::get('/su/submit-reset-password', 'AuthController@submitResetPasswordForm')->name('reset.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'AuthController@logout')->name('cms.users.logout');

    # Dashboard
    Route::get('/dashboard', 'DashboardController@dashboard')->name('cms.users.dashboard')->middleware('access:cms.users.dashboard');

    # Users
    Route::get('/users', 'UserController@list')->name('cms.users.list')->middleware('access:cms.users.list');
    Route::get('/users/add', 'UserController@add')->name('cms.users.add')->middleware('access:cms.users.add');
    Route::post('/users/add', 'UserController@save')->name('cms.users.save')->middleware('access:cms.users.save');
    Route::get('/users/edit/{token}', 'UserController@edit')->name('cms.users.edit')->middleware('access:cms.users.edit');
    Route::post('/users/edit/{token}', 'UserController@update')->name('cms.users.update')->middleware('access:cms.users.update');
    Route::get('/users/delete/{token}', 'UserController@delete')->name('cms.users.delete')->middleware('access:cms.users.delete');
    Route::any('/users/serach', 'UserController@search')->name('cms.users.search')->middleware('access:cms.users.search');
    Route::get('/users/status/{token}/{type}', 'UserController@status')->name('cms.users.status')->middleware('access:cms.users.status');
    Route::get('/users/logins/{token}', 'UserController@loginLogs')->name('cms.users.logins')->middleware('access:cms.users.logins');

    #Roles
    Route::get('/roles', 'RoleController@list')->name('cms.roles.list')->middleware('access:cms.roles.list');
    Route::get('/roles/add', 'RoleController@add')->name('cms.roles.add')->middleware('access:cms.roles.add');
    Route::post('/roles/add', 'RoleController@save')->name('cms.roles.save')->middleware('access:cms.roles.save');
    Route::get('/roles/edit/{slug}', 'RoleController@edit')->name('cms.roles.edit')->middleware('access:cms.roles.edit');
    Route::post('/roles/edit/{slug}', 'RoleController@update')->name('cms.roles.update')->middleware('access:cms.roles.update');
    Route::get('/roles/delete/{slug}', 'RoleController@delete')->name('cms.roles.delete')->middleware('access:cms.roles.delete');
    Route::any('/roles/search', 'RoleController@search')->name('cms.roles.search')->middleware('access:cms.roles.search');
    Route::get('/roles/status/{slug}/{type}', 'RoleController@status')->name('cms.roles.status')->middleware('access:cms.roles.status');

    #Permissions
    Route::get('/permissions', 'PermissionController@list')->name('cms.permissions.list')->middleware('access:cms.permissions.list');
    Route::any('/permissions/serach', 'PermissionController@search')->name('cms.permissions.search')->middleware('access:cms.permissions.search');
    Route::get('/permissions/status/{slug}/{type}', 'PermissionController@status')->name('cms.permissions.status')->middleware('access:cms.permissions.status');
    Route::get('/permissions/migration', 'PermissionController@permissionMigration')->name('cms.permissions.migration')->middleware('access:cms.permissions.migration');
    Route::get('/permissions/migrate', 'PermissionController@permissionMigrate')->name('cms.permissions.migrate')->middleware('access:cms.permissions.migrate');

});