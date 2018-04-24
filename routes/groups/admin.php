<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'finished-account'], function() {

    Route::get('/corporation', 'CorporationController@index')
        ->name('corporation.index')
        ->middleware('can:create,Asgard\Models\Corporation');


    Route::post('/corporation/add', 'CorporationController@store')
        ->name('corporation.store')
        ->middleware('can:create,Asgard\Models\Corporation');


    Route::get('/corporation/{corporation}', 'CorporationController@show')
        ->name('corporation.show')
        ->middleware('can:view,corporation');


    Route::post('/corporation/{corporation}/update', 'CorporationController@update')
        ->name('corporation.update')
        ->middleware('can:update,corporation');


    //roles
    Route::get('/roles', 'RoleController@index')
        ->name('roles.index')
        ->middleware('can:view,Silber\Bouncer\Database\Role');

    Route::get('/roles/create', 'RoleController@create')
        ->name('roles.create')
        ->middleware('can:create,Silber\Bouncer\Database\Role');

    Route::post('/roles/store', 'RoleController@store')
        ->name('roles.store')
        ->middleware('can:create,Silber\Bouncer\Database\Role');

    Route::get('/roles/{role}/edit', 'RoleController@edit')
        ->name('roles.edit')
        ->middleware('can:update,role');

    Route::post('/roles/{role}/update', 'RoleController@update')
        ->name('roles.update')
        ->middleware('can:update,role');

    Route::get('/roles/{role}/destroy', 'RoleController@destroy')
        ->name('roles.destroy')
        ->middleware('can:delete,role');


    //settings
    Route::get('/settings', 'SettingsController@index')
        ->name('settings.index')
        ->middleware('can:view,Asgard\Models\Setting');
});