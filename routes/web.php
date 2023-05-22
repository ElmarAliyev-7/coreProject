<?php

use System\Route;

/* Front */
Route::get('/', App\Http\Controllers\Front\HomeController::class, 'index');
Route::get('/blogs/show/{id}', App\Http\Controllers\Front\BlogController::class, 'show');
/* Admin */
Route::get('/admin', App\Http\Controllers\Admin\AuthController::class, 'login');
Route::get('/admin/logout', App\Http\Controllers\Admin\AuthController::class, 'logout');

Route::get('/admin/dashboard', App\Http\Controllers\Admin\Dashboard::class, 'index');
Route::get('/admin/blogs', App\Http\Controllers\Admin\BlogController::class, 'index');
Route::get('/admin/blogs/create', App\Http\Controllers\Admin\BlogController::class, 'create');
Route::get('/admin/sliders', App\Http\Controllers\Admin\SliderController::class, 'index');
Route::get('/admin/sliders/create', App\Http\Controllers\Admin\SliderController::class, 'create');
/* Run */
Route::run();
