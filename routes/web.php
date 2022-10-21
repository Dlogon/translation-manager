<?php

use Dlogon\TranslationManager\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use Dlogon\TranslationManager\Http\Controllers\TranslationController;

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

$routePrefixName = config("translation-manager.route.prefix", "translations");

Route::name("$routePrefixName.")->group(function() {
    Route::get('/', [TranslationController::class, 'index'])->name("index");

    Route::get('/api/langs', [TranslationController::class, 'getLangs'])->name("lang");
    Route::post('/langs', [TranslationController::class, 'addLang'])->name("lang.store");
    Route::get('/keys/{group?}', [TranslationController::class, 'getGroupKeys'])->name("group.keys");
    Route::post('/traslation', [TranslationController::class, 'addTranslation'])->name("addTranslation");
    Route::put('/traslation', [TranslationController::class, 'updateTranslation']);
    Route::post('/traslations', [TranslationController::class, 'createTranslationsFiles'])->name("generate");
    Route::post('/key', [TranslationController::class, 'addKey'])->name("key.store");;

    Route::get('/modeltranslations', [TranslationController::class, 'modelTranslations'])->name("modeltranslations");
    Route::post('/modeltranslationsgroups', [TranslationController::class, 'modelTransationGroups'])->name("modeltranslationsgroups");

    // GROUPS

    Route::resource("group", GroupController::class);

    // Route::get('/groups', [GroupController::class, 'index'])->name("groups");
    // Route::get('/groups', [GroupController::class, 'index'])->name("groups");
});





