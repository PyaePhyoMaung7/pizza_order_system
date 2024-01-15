<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController as UController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController ;

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
// log in, register
Route::middleware(['auth_middleware'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class, 'registerPage'])->name('auth#registerPage');
});



Route::middleware([
    'auth',
    // config('jetstream.auth_session'),
    // 'verified',
])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class, 'dashboard'])->name('dashboard');

    // admin

    Route::middleware(['admin_auth'])->group(function(){

        //category
        Route::prefix('category')->group (function () {
            Route::get('listPage',[CategoryController::class, 'listPage'])->name('category#list');
            Route::get('createPage',[CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('categoryCreate',[CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update',[CategoryController::class, 'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/changePage',[AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class, 'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('details',[AdminController::class, 'details'])->name('admin#details');
            Route::get('edit',[AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class, 'update'])->name('admin#update');

            Route::get('list',[AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class, 'delete'])->name('admin#delete');

            //change role
            // Route::get('changeRole/{id}',[AdminController::class, 'changeRole'])->name('admin#changeRole');
            // Route::post('changeRole/{id}',[AdminController::class, 'change'])->name('admin#change');
            Route::get('change/role',[AdminController::class, 'changeRole'])->name('admin#changeRole');

        });

        //products
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class, 'list'])->name('product#list');
            Route::get('create',[ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class, 'delete'])->name('product#delete');
            Route::get('show/{id}',[ProductController::class, 'show'])->name('product#show');
            Route::get('editPage/{id}',[ProductController::class, 'editPage'])->name('product#editPage');
            Route::post('update',[ProductController::class, 'update'])->name('product#update');
        });

        //orders
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class, 'orderList'])->name('order#list');
            Route::get('change/status',[OrderController::class, 'changeStatus'])->name('order#changeStatus');
            Route::get('ajax/change/status',[OrderController::class, 'ajaxChangeStatus'])->name('order#ajaxChangeStatus');
            Route::get('item/list/{orderCode}',[OrderController::class, 'itemList'])->name('order#itemList');
        });

        //user list
        Route::prefix('user')->group(function () {
            Route::get('list',[UController::class, 'userList'])->name('user#list');
            Route::get('change/role',[UController::class, 'changeRole'])->name('user#changeRole');
            Route::get('delete/{id}',[UController::class, 'delete'])->name('user#delete');
        });

        //contact
        Route::prefix('message')->group(function () {
            Route::get('list',[AdminController::class, 'messageList'])->name('admin#messageList');
            Route::get('show/{id}',[AdminController::class, 'showFullMessage'])->name('admin#showFullMessage');
            Route::get('delete/{id}',[AdminController::class, 'deleteMessage'])->name('admin#deleteMessage');
        });


    });

    //user
    Route::middleware(['user_auth'])->group(function(){

        //home
        Route::prefix('user')->group (function (){
            Route::get('home',[UserController::class, 'home'])->name('user#home');
            Route::get('filter/{id}',[UserController::class, 'filter'])->name('user#filter');
            Route::get('history',[UserController::class, 'history'])->name('user#history');

            Route::prefix('pizza')->group(function () {
                Route::get('details/{id}',[UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');

            });

            Route::prefix('cart')->group(function () {
                Route::get('list',[UserController::class, 'cartList'])->name('user#cartList');

            });

            //user password
            Route::prefix('password')->group(function () {
                Route::get('change',[UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
                Route::post('change',[UserController::class, 'changePassword'])->name('user#changePassword');
            });

            //user profile details
            Route::prefix('account')->group(function () {
                Route::get('change',[UserController::class, 'accountChangePage'])->name('user#accountChangePage');
                Route::post('change/{id}',[UserController::class, 'accountChange'])->name('user#accountChange');
            });

            Route::prefix('ajax')->group(function () {
                Route::get('pizzaList',[AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
                Route::get('addToCart',[AjaxController::class, 'addToCart'])->name('ajax#addToCart');
                Route::get('order',[AjaxController::class, 'order'])->name('ajax#order');
                Route::get('clear/cart',[AjaxController::class, 'clearCart'])->name('ajax#clearCart');
                Route::get('clear/product',[AjaxController::class, 'clearProduct'])->name('ajax#clearProduct');
                Route::get('increase/view/count',[AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
            });

            //user contact
            Route::prefix('contact')->group(function () {
                Route::get('form',[UserController::class, 'contactForm'])->name('user#contactForm');
                Route::post('send/message',[UserController::class, 'sendMessage'])->name('user#sendMessage');
            });

        });
    });


});






