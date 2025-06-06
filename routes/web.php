<?php

use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShowPostComponent;
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

Route::get('/', HomeComponent::class)->name('home');
Route::get('/category/{category?}/tag/{tag?}', HomeComponent::class)->name('home-by-category');
Route::get('/post/{post}', ShowPostComponent::class)->name('show-post');

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

        Route::get('post-datatables', function () {
            return view('post.index');
        })->name('posts');

        Route::get('tag-datatables', function () {
            return view('tag.index');
        })->name('tags');
    });

require __DIR__ . '/auth.php';
