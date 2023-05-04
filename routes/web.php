<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;


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

Route::get('/', [PageController::class, 'homePage'])->name('home');

Route::get('/random-images', [PageController::class, 'getRandomImages'])->name('random-images');


// Middleware Generico
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/account', [PageController::class, 'myAccount'])->name('account');
    Route::get('/adverts/create', [AdvertController::class, 'create'])->name('adverts.create');

    // Rotta resource modifica info account
    Route::resource('bio', AccountController::class);

    // Richiesta di collaborare con noi
    Route::get('/richiesta/revisore', [AdminController::class, 'becomeReviser'])->name('become-reviser');

    // Richiesta di collaborare con noi
    Route::get('/accessi/revisore', [AdminController::class, 'becomeReviser'])->name('revisore');

    // Fai diventare un utente revisore
    Route::get('admin/applications/approved/makereviser{user}', [AdminController::class, 'makeReviser'])->name('approved-reviser');
    //
    Route::post('/sendmail',  [PageController::class, 'sendEmail'])->name('send');

    // Cambia immagine profilo
    Route::post('/storepic/{id}', [AccountController::class, 'updateProfilePicture'])->name('store-pic');
});

// Middleware Staff Permessi
Route::middleware(['setrole'])->group(function () {
    // Sezione ruolo
    Route::get('/admin/panel', [AdminController::class, 'index'])->name('panel-index');
    // Accetta annuncio
    Route::patch('/accept/advert/{advert}', [AdminController::class, 'acceptAdvert'])->name('allow-advert');
    // Rifiuta annuncio
    Route::patch('/refuse/advert/{advert}', [AdminController::class, 'rejectAdvert'])->name('refuse-advert');
});


// Rotte pubbliche
Route::get('/adverts/index', [AdvertController::class, 'index'])->name('show-adverts');
Route::get('/adverts/advdetail/{id}', [AdvertController::class, 'advertDetail'])->name('adv-detail');
Route::get('/categoria/{category}', [PageController::class, 'categoryShow'])->name('categoryShow');
Route::get('/contact', [PageController::class, 'contact'])->name('contacts');
Route::get('/grazie', [PageController::class, 'thankYou'])->name('thank-you');

// Middleware Staff Permessi
Route::middleware(['setrole'])->group(function () {
    // Sezione ruolo
    Route::get('/admin/panel', [AdminController::class, 'index'])->middleware('setrole')->name('panel-index');
    // Accetta annuncio
    Route::patch('/accept/advert/{advert}', [AdminController::class, 'acceptAdvert'])->middleware('setrole')->name('allow-advert');
    // Rifiuta annuncio
    Route::patch('/refuse/advert/{advert}', [AdminController::class, 'rejectAdvert'])->middleware('setrole')->name('refuse-advert');
});

//* Ricerca annuncio usando Scout~TNT Search
Route::get('adverts/search', [AdvertController::class, 'searchAdverts'])->name('adverts.search');

//* Autenticazione tramite Gmail
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//* Autenticazione tramite Facebook
Route::get('auth/{provider}/redirect', [FacebookController::class, 'redirect'])->name('auth.socialite.redirect');
Route::get('auth/{provider}/callback', [FacebookController::class, 'callback'])->name('auth.socialite.callback');
Route::get('auth/{provider}/user', [FacebookController::class, 'index']);

// /auth/facebook/redirect rotta per facebook

Route::post('lingua/{lang}', [PageController::class, 'setLanguage'])->name('set_language_locale');
