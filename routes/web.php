<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Recetas;
use App\Livewire\Ingredientes;
use App\Livewire\Categorias;
use App\Livewire\Menus;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/recetas', Recetas::class)->name('recetas');
Route::get('/ingredientes', Ingredientes::class)->name('ingredientes');
Route::get('/categorias', Categorias::class)->name('categorias');
Route::get('/menus', Menus::class)->name('menus');
