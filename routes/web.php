<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\UnggahController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\UserController;
use App\Models\Foto;

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
Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/posts', 'index');
});

// Route Notification
Route::get('/notif', [NotifController::class, 'index'])->middleware('auth');

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

route::get('/layout', function (){
    return view('layout.main');
});

//Route Album
Route::controller(AlbumController::class)->group(function() {

    Route::get('/dashboard/album', 'index')->middleware('auth');
    Route::get('/dashboard/album/create', 'create')->middleware('auth');
    Route::post('/dashboard/album/store', 'store')->middleware('auth');
    Route::post('/dashboard/album/delete/{id}', 'delete')->middleware('auth');
    Route::get('/dashboard/album/edit/{album}', 'edit')->middleware('auth');
    Route::post('/dashboard/album/update/{album}', 'update')->middleware('auth') ;
});

// Route Foto
Route::resource('/dashboard/foto', FotoController::class)->middleware('auth');

// Route unggah
Route::post('/unggah/{foto}', [UnggahController::class, 'unggah']);

// Route like
Route::controller(LikeController::class)->group(function() {
    Route::post('/like', 'like');
    Route::post('/like/dashboard', 'like_in_dashboard');
    Route::post('/dislike/{like:foto_id}', 'dislike');
    Route::post('/dislike/dashboard/{like:foto_id}', 'dislike_in_dashboard');
});

// Route komentar
Route::controller(KomentarController::class)->group(function(){
    Route::post('/komen', 'komen');
    Route::post('/komen/hapus/{komen}', 'delete');
    Route::post('/dashboard/komen/hapus/{komen}', 'dashboard_delete');
});


// Route User/Auth
Route::controller(UserController::class)->group(function(){
    Route::get('/register', 'index')->middleware('guest');
    Route::post('/register', 'store')->middleware('guest');;
    Route::get('/login', 'index_login')->name('login')->middleware('guest');
    Route::post('/login/auth', 'authtenticate')->middleware('guest');
    Route::post('/logout', 'logout');
});

