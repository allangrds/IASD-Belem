<?php

use App\ChurchMembers;
use App\News;
use App\Photos;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

Route::middleware('throttle:15,1')->group(function () {
    Route::get('/', function () {
        $news = News::whereDate('published_at', '<=', date('Y-m-d'))
            ->where('show_on_home', true)
            ->paginate(5);
        $photos = Photos::join('news', 'news.id', '=', 'photos.news_id')
            ->whereDate('news.published_at', '<=', date('Y-m-d'))
            ->paginate(3);

        return view('portal.home')
            ->with('photos', $photos)
            ->with('news', $news);
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

    Route::get('/noticias/{id}', function ($id) {
        $new = News::where('id', $id)->first();
        $photos =  Photos::where('news_id', $new->id)->get();

        return view('portal.new')
            ->with('new', $new)
            ->with('photos', $photos);
    })->name('portal_noticias_descricacao');

    Route::get('/informativo', function () {
        $weekMap = [
            0 => 'domingo',
            1 => 'segunda',
            2 => 'terca',
            3 => 'quarta',
            4 => 'quinta',
            5 => 'sexta',
            6 => 'sabado',
        ];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $schedule = Schedule::where('is_active', true)
            ->where('specific_day', date('Y-m-d'))
            ->orWhere('week_day', $weekday)
            ->orderBy('specific_day', 'desc')
            ->first();
        $members = null;

        $news = null;

        if ($schedule) {
            $news = News::whereDate('published_at', '=', date('Y-m-d'))
                ->where('show_on_informative', true)
                ->get();

            $members = ChurchMembers::where(DB::raw('DAY(born_at)'), '=', date('d'))
                ->where(DB::raw('MONTH(born_at)'), '=', date('m'))
                ->get();
        }

        return view('portal.informativo')
            ->with('news', $news)
            ->with('schedule', $schedule)
            ->with('members', $members);
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

Route::middleware(['throttle:25,1', 'auth'])->prefix('administrativo')->group(function () {
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

    Route::prefix('programacoes')->group(function () {
        Route::get('/', 'Panel\ScheduleController@index')
            ->name('panel_schedule');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\ScheduleController@create')
                ->name('panel_schedule_create');

            Route::post('/', 'Panel\ScheduleController@store')
                ->name('panel_schedule_store');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'Panel\ScheduleController@edit')
                ->name('panel_schedule_edit');

            Route::patch('/', 'Panel\ScheduleController@update')
                ->name('panel_schedule_update');

            Route::delete('/', 'Panel\ScheduleController@destroy')
                ->name('panel_schedule_destroy');
        });
    });

    Route::prefix('noticias')->group(function () {
        Route::get('/', 'Panel\NewsController@index')
            ->name('panel_news');

        Route::prefix('criar')->group(function () {
            Route::get('/', 'Panel\NewsController@create')
                ->name('panel_news_create');

            Route::post('/', 'Panel\NewsController@store')
                ->name('panel_news_store');
        });

        Route::prefix('/{id}')->group(function () {
            Route::get('/', 'Panel\NewsController@edit')
                ->name('panel_news_edit');

            Route::patch('/', 'Panel\NewsController@update')
                ->name('panel_news_update');

            Route::delete('/', 'Panel\NewsController@destroy')
                ->name('panel_news_destroy');
        });
    });
});
