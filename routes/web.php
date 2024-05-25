<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MarketController::class, 'home'])->name('home');
Route::get('/login', [MarketController::class, 'login'])->name('login');
Route::get('/products', [MarketController::class, 'product'])->name('product');

Route::get('/register', [MarketController::class, 'register'])->name('register');
Route::post('/register-user', [MarketController::class, 'registerUser'])->name('register_user');
Route::get('/login', [MarketController::class, 'login'])->name('login');
Route::post('/login', [MarketController::class, 'loginUser'])->name('login_user');
Route::post('/logout', [MarketController::class, 'logout'])->name('logout');

Route::get('/dashboard', [MarketController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [MarketController::class, 'getProfile'])->name('get_profile');

Route::get('/admin/lists', [MarketController::class, 'getAdmin'])->name('admin_page')->middleware(['authenticate', 'role:superadmin']);
Route::get('/tambah-product', [MarketController::class, 'handleRequest'])->name('form_product');
Route::post('/post-request', [MarketController::class, 'postRequest'])->name('postRequest');
Route::get('/product/{product}', [MarketController::class, 'editProduct'])->name('edit_product');
Route::put('/product/{product}/update', [MarketController::class, 'updateProduct'])->name('update_product');
Route::post('/product/{product}/delete', [MarketController::class, 'deleteProduct'])->name('delete_product');
Route::get('/product/{product}/detail', [MarketController::class, 'detailProduct'])->name('detail_product')->middleware(['authenticate', 'role:superadmin|user']);
Route::get('/transaction-detail', [MarketController::class, 'detailTransaksi'])->name('detail_transaksi');

Route::post('/admin/import', [MarketController::class, 'importProduct'])->name('import_data');

Route::get('/export-produk', [MarketController::class, 'exportData'])->name('exportData');

