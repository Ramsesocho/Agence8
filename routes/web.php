<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PropertyController as ControllersPropertyController;
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

$idRegex='[0-9]+';
$slugRegex='[0-9a-z\-]+';

Route::get('/',[HomeController::class,'index']);
Route::get('/bien',[ControllersPropertyController::class,'index'])->name('property.index');
Route::get('/bien/{slug}-{property}',[ControllersPropertyController::class,'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex
]);

Route::post('/biens/{property}/contact', [ControllersPropertyController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex,
]);

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'dologin']);
Route::delete('/login', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::get('/images/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() use ($idRegex){
        Route::resource('property',PropertyController::class)->except(['show']);
        Route::resource('option',OptionController::class)->except(['show']);
        Route::delete('picture/{picture}', [PictureController::class, 'destroy'])->name('picture.destroy')->where([
            'picture' => $idRegex,
        ]);
});

