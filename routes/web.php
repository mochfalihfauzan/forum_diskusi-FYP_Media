<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\testController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/create', [TopicsController::class, 'create'])->name('topics.create')->middleware('auth');
Route::post('/store', [TopicsController::class, 'store'])->name('topics.store');
Route::get('/show/{id}', [TopicsController::class, 'show'])->name('topics.show');
Route::get('/edit/{id}', [TopicsController::class, 'edit'])->name('topics.edit');
Route::put('/update/{id}', [TopicsController::class, 'update'])->name('topics.update');
Route::delete('/delete-topic/{id}', [TopicsController::class, 'destroy'])->name('topics.delete');

Route::post('/comments/{id}', [CommentsController::class, 'store'])->name('comments.store')->middleware('auth');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard-old', [DashboardController::class, 'dashboard_old'])->middleware(['auth', 'verified'])->name('dashboard-old');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', [testController::class, 'index'])->middleware(['auth']);
require __DIR__ . '/auth.php';
