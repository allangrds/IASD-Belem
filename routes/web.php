<?php

Route::middleware('throttle:25,1')->group(function () {
    Route::get('/', function () {
        return view('portal.home');
    })->name('portal_home');

    Route::get('/lideranca', function () {
        $functions = App\MemberFunction::get(['id', 'name']);
        $departments = App\Departments::get(['id', 'name']);
        $leaderships = App\ChurchMembers::where('is_active', true)
            ->orWhereRaw('function_id <> ""')
            ->orWhereRaw('department_id <> ""')
            ->get();

        return view('portal.lideranca')
            ->with('leaderships', $leaderships)
            ->with('departments', $departments)
            ->with('functions', $functions);
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
});

Route::middleware(['throttle:25,1', 'auth'])->group(function () {
    Route::get('/painel', 'Panel\PanelController@index')
        ->name('panel_home');

    Route::prefix('membros-da-igreja')->group(function () {
        Route::get('/', 'Panel\ChurchMembersController@index')
            ->name('panel_church_members');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\ChurchMembersController@create')
                ->name('panel_church_members_create');

            Route::post('/', 'Panel\ChurchMembersController@store')
                ->name('panel_church_members_store');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'Panel\ChurchMembersController@edit')
                ->name('panel_church_members_edit');

            Route::patch('/', 'Panel\ChurchMembersController@update')
                ->name('panel_church_members_update');

            Route::delete('/', 'Panel\ChurchMembersController@destroy')
                ->name('panel_church_members_destroy');
        });
    });

    Route::prefix('usuarios')->middleware(['can:handle_user'])->group(function () {
        Route::get('/', 'Panel\UsersController@index')
            ->name('panel_users');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\UsersController@create')
                ->name('panel_users_create');

            Route::post('/', 'Panel\UsersController@store')
                ->name('panel_users_store');
        });

        Route::delete('/{id}', 'Panel\UsersController@destroy')
            ->name('panel_users_destroy');
    });

    Route::prefix('cargos')->group(function () {
        Route::get('/', 'Panel\MembersFunctionController@index')
            ->name('panel_members_function');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\MembersFunctionController@create')
                ->name('panel_members_function_create');

            Route::post('/', 'Panel\MembersFunctionController@store')
                ->name('panel_members_function_store');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'Panel\MembersFunctionController@edit')
                ->name('panel_members_function_edit');

            Route::patch('/', 'Panel\MembersFunctionController@update')
                ->name('panel_members_function_update');

            Route::delete('/', 'Panel\MembersFunctionController@destroy')
                ->name('panel_members_function_destroy');
        });
    });

    Route::prefix('departamentos')->group(function () {
        Route::get('/', 'Panel\DepartmentsController@index')
            ->name('panel_departments');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\DepartmentsController@create')
                ->name('panel_departments_create');

            Route::post('/', 'Panel\DepartmentsController@store')
                ->name('panel_departments_store');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'Panel\DepartmentsController@edit')
                ->name('panel_departments_edit');

            Route::patch('/', 'Panel\DepartmentsController@update')
                ->name('panel_departments_update');

            Route::delete('/', 'Panel\DepartmentsController@destroy')
                ->name('panel_departments_destroy');
        });
    });
});
