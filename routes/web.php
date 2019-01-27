<?php

Route::get('/', function () {
    return view('portal.home');
})->name('portal_home');

Route::get('/fale-conosco', function () {
    return view('portal.contato');
})->name('portal_contato');
