<?php

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TrashedController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class,'index'])->name('homepage');

Route::resource('notes',NoteController::class);

Route::get('trashed',[TrashedController::class,'index'])->name('trashed.index');
Route::put('trashed/{note}',[TrashedController::class,'update'])->name('trashed.update')->withTrashed();
Route::delete('/trashed/{note}',[TrashedController::class,'destroy'])->name('trashed.destroy')->withTrashed();
Route::post('/trashed/all',[TrashedController::class,'destroyAll'])->name('trashed.destroyAll');
Route::post('/trashed/resall',[TrashedController::class,'restoreall'])->name('trashed.restoreAll');


// Not recommended
Route::get('/trashed/deleted',function(){
    return to_route('trashed.index')->with('success','All Selected Notes Deleted Forever');
})->name('all.deleted');

Route::get('/trashed/restored',function(){
    return to_route('trashed.index')->with('success','All Selected Notes Restored Successfully');
})->name('all.restored');


Auth::routes();
