<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfilController;
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

Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/test', [IdeaController::class, 'Edit']);
Route::get('/beitrag/{idea:slug}', [IdeaController::class, 'show'])->name('idea.show');

Route::get('/profil', [ProfilController::class, 'index'])->middleware('auth')->name('profil.index');


Route::get('/chat/{user}/{idea}/{conversation}', [IdeaController::class, 'update'])->name('chat.show');

Route::get('/conversation', [IdeaController::class, 'chatView'])->name('chat.view');

Route::post('/profil', [ProfilController::class, 'edit'])->name('profil.edit');

Route::post('/broadcasting/auth', function () {
    return Auth::user();
 });
require __DIR__.'/auth.php';

