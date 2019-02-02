<?php

Route::get('/', function () {
    return view('portal.home');
})->name('portal_home');

Route::get('/lideranca', function () {
    return view('portal.lideranca');
})->name('portal_lideranca');

Route::get('/fale-conosco', function () {
    return view('portal.contato');
})->name('portal_contato');
