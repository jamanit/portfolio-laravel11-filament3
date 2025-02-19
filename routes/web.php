<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{username?}', [App\Http\Controllers\PortfolioController::class, 'index'])->name('portfolio');
Route::get('/{username?}/project', [App\Http\Controllers\PortfolioController::class, 'project'])->name('project');
Route::get('/{username?}/project-detail/{id}', [App\Http\Controllers\PortfolioController::class, 'project_detail'])->name('project_detail');
Route::get('/{username?}/skill', [App\Http\Controllers\PortfolioController::class, 'skill'])->name('skill');
Route::get('/{username?}/experience', [App\Http\Controllers\PortfolioController::class, 'experience'])->name('experience');
Route::get('/{username?}/testimonial', [App\Http\Controllers\PortfolioController::class, 'testimonial'])->name('testimonial');
