<?php

use App\Controllers\AdminController;
use App\Controllers\CategorieController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Controllers\ReviewController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    Route::get('/', [HomeController::class, 'index']),


    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register']),

    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/admin', [AdminController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/admin/categories/add', [CategorieController::class, 'create']),

    Route::post('/admin/categories/add', [CategorieController::class, 'store']),
    Route::post('/admin/categories/destroy', [CategorieController::class, 'destroy']),
    Route::get('/admin/categories/update', [CategorieController::class, 'edit']),
    Route::post('/admin/categories/update', [CategorieController::class, 'update']),
    Route::get('/categories', [CategorieController::class, 'index']),


    Route::get('/movie', [MovieController::class, 'show']),
    Route::get('/admin/movies/add', [MovieController::class, 'create'], [AuthMiddleware::class]),
    Route::post('/admin/movies/add', [MovieController::class, 'store']),
    Route::post('/admin/movies/destroy', [MovieController::class, 'destroy']),
    Route::get('/admin/movies/update', [MovieController::class, 'edit']),
    Route::post('/admin/movies/update', [MovieController::class, 'update']),

    Route::post('/reviews/add', [ReviewController::class, 'store'])

];
