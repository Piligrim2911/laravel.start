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
    return view('welcome');
});
//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['web','auth'])->prefix('dashboard')->name('dashboard.')->namespace('\App\Http\Controllers\Dashboard')->group(function() {
    Route::get('/', 'IndexController@index')->name('index');

    Route::resource('/articles', 'ArticlesController')->except(['destroy', 'edit']);
    Route::get('/articles/{id}/edit', 'ArticlesController@edit')->name('articles.edit');
    Route::post('/articles/update-status/{item}', 'ArticlesController@updStatus')->name('articles.updateStatus');
    Route::delete('/articles/destroy/{id}', 'ArticlesController@destroy')->name('articles.destroy');
    Route::post('/articles/restore/{id}', 'ArticlesController@restore')->name('articles.restore');
    Route::delete('/articles/delete/{id}', 'ArticlesController@delete')->name('articles.delete');
});
