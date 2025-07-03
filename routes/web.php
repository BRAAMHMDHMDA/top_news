<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Website\About;
use App\Http\Livewire\Website\Auth\Actions\Logout;
use App\Http\Livewire\Website\Auth\Login;
use App\Http\Livewire\Website\Auth\Register;
use App\Http\Livewire\Website\Contact;
use App\Http\Livewire\Website\ListNews;
use App\Http\Livewire\Website\ShowNews;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::redirect('/', 'home');
    Route::get('/home', HomeController::class)->name('home');

    // Customer Profile
    Route::middleware(['auth:customer'])->group(function () {
        Route::get('/profile', \App\Http\Livewire\Website\Profile::class)->name('customer.profile');
    });

    Route::get('/news', ListNews::class)->name('news');
    Route::get('/news/{slug}', ShowNews::class)->name('news.show');
    Route::get('/about-us', About::class)->name('about-us');
    Route::get('/contact-us', Contact::class)->name('contact-us');

    Route::middleware('guest:customer')->group(function () {

        Route::get('/login', Login::class)->name('login');
        Route::get('/register', Register::class)->name('register');


    });
    Route::middleware('auth:customer')->group(function () {

        Route::post('/logout', function (Logout $logout) {
            $logout();
            return redirect()->route('home');
        })->name('logout');

    });

});

