<?php

use Illuminate\Support\Facades\Route;
use Dlogon\TranslationManager\Controller;

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

Route::get('/', [Controller::class, 'index'])->name("index");

Route::get('/api/langs', [Controller::class, 'getLangs']);
Route::post('/langs', [Controller::class, 'addLang']);
Route::get('/keys/{group?}', [Controller::class, 'getGroupKeys']);
Route::post('/traslation', [Controller::class, 'addTranslation']);
Route::put('/traslation', [Controller::class, 'updateTranslation']);
Route::post('/traslations', [Controller::class, 'createTranslationsFiles']);
Route::post('/key', [Controller::class, 'addKey']);

Route::get('/modeltranslations', [Controller::class, 'modelTranslations'])->name("modeltranslations");

Route::post('/modeltranslationsgroups', [Controller::class, 'modelTransationGroups'])->name("modeltranslationsgroups");


