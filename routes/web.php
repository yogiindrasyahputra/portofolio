<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioCommentController;
use App\Http\Controllers\PortfolioController;

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

Route::get('/', [PortfolioController::class, 'home'])->name('home');
Route::get('/{page}', [PortfolioController::class, 'show'])
    ->where('page', 'about|music|projects|certificates|achievements|tech-stack|contact')
    ->name('portfolio.page');
Route::get('/projects/{project}', [PortfolioController::class, 'project'])
    ->where('project', 'cyber-gyzin|bot-generate-artikel|database-siswa')
    ->name('projects.show');
Route::post('/comments', [PortfolioCommentController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('comments.store');
