<?php

Route::middleware('throttle:15,1')->group(function () {
    Route::get('/', function () {
        return view('portal.home');
    })->name('portal_home');

    Route::get('/lideranca', function () {
        return view('portal.lideranca');
    })->name('portal_lideranca');

    Route::get('/informativo', function () {
        return view('portal.informativo');
    })->name('portal_informativo');

    Route::get('/fale-conosco', function () {
        return view('portal.contato');
    })->name('portal_contato');

    Route::prefix('login')->group(function () {
        Route::get('/', 'Auth\LoginController@show')->name('login');
        Route::post('/', 'Auth\LoginController@login');
    });

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/painel', 'Panel\PanelController@index')
            ->name('panel_home');

        Route::prefix('usuarios')->middleware(['can:handle_user'])->group(function () {
            Route::get('/', 'Panel\UsersController@index')
                ->name('panel_users');

            Route::prefix('criar')->group(function () {
                Route::get('/', 'Panel\UsersController@create')
                    ->name('panel_users_create');

                Route::post('/', 'Panel\UsersController@store')
                    ->name('panel_users_store');
            });

            Route::delete('/${id}', 'Panel\UsersController@destroy')
                ->name('panel_users_destroy');
        });
    });
});
