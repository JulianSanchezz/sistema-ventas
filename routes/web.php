<?php

use Illuminate\Support\Facades\Auth;
use App\Livewire\Category\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home\Inicio;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Product\ProductShow;
use App\Livewire\User\UserComponent;
use App\Livewire\User\UserShow;
use App\Livewire\Client\ClientComponent;
use App\Livewire\Client\ClientShow;
use App\Livewire\Sale\SaleCreate;
use App\Livewire\Sale\SaleList;
use App\Livewire\Sale\SaleShow;

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

Auth::routes(['register'=>true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home',Inicio::class)->name('home');
Route::get('/categorias',CategoryComponent::class)->name('categories');
Route::get('/categorias/{category}',CategoryShow::class)->name('categories.show');

Route::get('/productos',ProductComponent::class)->name('products');
Route::get('/productos/{product}',ProductShow::class)->name('products.show');

Route::get('/usuarios',UserComponent::class)->name('users');
Route::get('/usuarios/{user}',UserShow::class)->name('users.show');

Route::get('/clientes',ClientComponent::class)->name('clients');
Route::get('/clientes/{client}',ClientShow::class)->name('clients.show');

Route::get('/ventas/crear',SaleCreate::class)->name('sales.create');

Route::get('/sales', SaleList::class)->name('sales.list');

Route::get('/sales/{sale}',SaleShow::class)->name('sales.show');


