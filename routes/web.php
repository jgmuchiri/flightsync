<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get('/login', function (){
    return redirect('/admin');
})->name('login');

Route::get('news', \App\Livewire\News::class);
Route::get('forums', \App\Livewire\Forums::class);
