<?php

use App\Livewire\Admin;
use App\Livewire\Welcome;
use App\Livewire\Sourcing;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', Welcome::class)->name('/');
Route::get('/admin', Admin::class)->middleware('auth');
Route::get('/sourcing', Sourcing::class)->middleware('auth');

Route::get('/logout', function() {
    Auth::logout();

    return redirect()->route('/');
});

Route::group(['middleware' => 'guest'], function(){

    //register
    Route::get('/register', Register::class)->name('register');

    //login
    Route::get('/login', Login::class)->name('login');
});
