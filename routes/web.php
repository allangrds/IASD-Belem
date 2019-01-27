<?php

Route::get('/', function () {
    return view('portal.home');
})->name('portal_home');
