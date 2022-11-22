<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('blog.home');
});

Route::get('/post', function () {
    return view('blog.post');
});


Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('category-datatables', function () {
            return view('category.index');
        })->name('categories');
    });

require __DIR__ . '/auth.php';
