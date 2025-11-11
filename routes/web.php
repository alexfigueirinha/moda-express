<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\User\UserEdit;
use App\Livewire\User\UserIndex;
use App\Livewire\Produtos;
use App\Livewire\StockManagement;
use Illuminate\Support\Facades\Route;


Route::get('/', Login::class)->name('login');
Route::get('/dashboard', Dashboard::class)->middleware('auth')->name('dashboard');
Route::get('/user', UserIndex::class)->middleware('auth')->name('user.index');
Route::get('/user/edit/{id}', UserEdit::class)->middleware('auth')->name('user.edit');

Route::get('/produtos', Produtos::class)->name('products')->middleware('auth');
Route::get('/stock', StockManagement::class)->name('stock')->middleware('auth');