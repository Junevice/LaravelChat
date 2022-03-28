<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\SocialController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('groups/{id}', function($id){
    $query = auth()->user()->groups()->get()->pluck('id');
    $ids = [];
    foreach ($query as $key => $value) {
        array_push($ids, $value);
    }
    if(!in_array($id, $ids)) return redirect('/dashboard');
    return view('groups', ['id' => $id]);
})->middleware(['auth'])->name('groups');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::view('{any}', 'dashboard')
//     ->middleware('auth')
//     ->where('any', '.*');
    
Route::get('/messages', [ChatsController::class, 'fetchMessages']);
Route::get('/groups', [ChatsController::class, 'fetchGroups']);
Route::post('/messages', [ChatsController::class, 'sendMessage']);

require __DIR__.'/auth.php';


//Google Authentication Routes
Route::get('auth/google', [SocialController::class, 'googleRedirect']);
Route::get('auth/google/callback', [SocialController::class, 'googleLoginOrRegister']);
