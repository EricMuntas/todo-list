<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route(route: 'list.index');
});

Route::view('register', 'auth.register')->name('show.register');

Route::view('login', 'auth.login')->name('show.login');

Route::post('register', [LoginController::class, 'register'])->name('auth.register');
Route::post( 'login', [LoginController::class, 'login'])->name('auth.login');
Route::get( 'logout', [LoginController::class, 'logout'])->name('auth.logout');


Route::controller(ListController::class)->group(function() {

    Route::get('list', 'index')->name('list.index');

    // Si està autenticat:
     Route::middleware('auth')->group(function() {

         Route::get('list/add', 'create')->name('list.create');

         Route::post('list', 'store')->name('list.store');

         Route::get('list/{list}', 'show')->name('list.show');

         Route::delete('list/{list}', 'destroy')->name('list.destroy');
     
         Route::get('list/{list}/edit', 'edit')->name('list.edit');
     
         Route::put('list/{list}/edit', 'update')->name('list.update');
     
         Route::put('list/{list}', 'updateChecked')->name('list.updateChecked');

         Route::get('filter', 'filter')->name('list.filter');
         
     });  

   


});