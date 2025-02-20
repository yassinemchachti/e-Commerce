<?php

use App\Http\Controllers\EtatController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeReglementController;
use App\Http\Controllers\SousFamilleController;
use App\Http\Controllers\UniteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

//Famille
Route::resource('familles',FamilleController::class);
// DataTable Route
Route::get('datatable/data', [FamilleController::class, 'getfamilles'])->name('familles.data');


//SousFamille
Route::resource('sousfamilles',SousFamilleController::class);
// DataTable Route
Route::get('datatable/sousfamillesdata', [SousFamilleController::class, 'getsousfamilles'])->name('sousfamilles.data');

//Marque
Route::resource('marques',MarqueController::class);
// DataTable Route
Route::get('datatable/marques', [MarqueController::class, 'getMarques'])->name('marques.data');


//Unite
Route::resource('unites',UniteController::class);
// DataTable Route
Route::get('datatable/unites', [UniteController::class, 'getUnites'])->name('unites.data');


//Etat
Route::resource('etats',EtatController::class);
// DataTable Route
Route::get('datatable/etats', [EtatController::class, 'getEtats'])->name('etats.data');



//Mode regelement
Route::resource('mode_reglements',ModeReglementController::class);
// DataTable Route
Route::get('datatable/etats', [ModeReglementController::class, 'getmode_reglements'])->name('mode_reglements.data');
