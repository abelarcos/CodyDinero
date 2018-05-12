<?php


Route::get('/', function () {
    return redirect()->to('home');
});

Auth::routes();

Route::resource('movements', 'MovementsController');

Route::get('/home', 'HomeController@index')->name('home');
