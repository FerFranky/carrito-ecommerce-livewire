<?php

use App\Livewire\Products\ShowProducts;
use Illuminate\Support\Facades\Route;

Route::get('/', ShowProducts::class)->name('show-products.index');
