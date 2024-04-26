<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;

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

//Route::get('/', function () {
    //return view('welcome');
//})->name('welcome')->middleware('auth');

//Route::get('/', function () {
//    return view('records.index');
//})->name('index')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(RecordController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/', 'search')->name('search');
    Route::get('/records/create', 'create')->name('create');
    Route::get('/records/{record}', 'show')->name('show');
    Route::post('/records', 'store')->name('store');
    Route::get('/records/{record}/edit', 'edit')->name('edit');
    Route::put('/records/{record}', 'update')->name('update');
    Route::delete('/records/{record}', 'delete')->name('delete');
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::post('/comments', 'store')->name('store_comment');
    Route::put('/comments/{comment}', 'update')->name('update_comment');
    Route::delete('/comments/{comment}', 'delete')->name('delete_comment');
});

Route::controller(ReplyController::class)->middleware(['auth'])->group(function(){
    Route::post('/replies', 'store')->name('store_reply');
    Route::put('/replies/{reply}', 'update')->name('reply_comment');
    Route::delete('/replies/{reply}', 'delete')->name('delete_reply');
});

require __DIR__.'/auth.php';
