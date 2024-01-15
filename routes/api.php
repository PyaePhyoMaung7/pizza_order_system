<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('product/list',[RouteController::class, 'productList']); //READ *

Route::get('product/list/{id}',[RouteController::class, 'product']); //READ 1

Route::get('category/list',[RouteController::class, 'categoryList']);

Route::get('category/list/{id}',[RouteController::class, 'category']);

Route::get('user/list',[RouteController::class, 'userList']);

Route::get('user/list/{id}',[RouteController::class, 'user']);

Route::get('admin/list',[RouteController::class, 'adminList']);

Route::get('admin/list/{id}',[RouteController::class, 'admin']);

Route::get('order/list',[RouteController::class, 'orderList']);

Route::get('order/list/{id}',[RouteController::class, 'order']);

Route::get('contact/list',[RouteController::class, 'contactList']);

Route::get('contact/list/{id}',[RouteController::class, 'contact']);





//POST
//create category //key --> category_name
Route::post('create/category',[RouteController::class, 'createCategory']); //CREATE

//delete with get method
Route::get('delete/category/{id}',[RouteController::class, 'deleteCategory']); //DELETE

//update with post method //key --> category_id, category_name
Route::post('update/category',[RouteController::class, 'updateCategory']); //UPDATE

//create contact // key --> name, email, message
Route::post('create/contact',[RouteController::class, 'createContact']);

//delete contact
Route::get('delete/contact/{id}',[RouteController::class, 'deleteContact']);

//delete user
Route::post('delete/user',[RouteController::class, 'deleteUser']);

//delete with post method
// Route::post('delete/category/{id}',[RouteController::class, 'deleteCategory']);

// Route::post('create/user',[RouteController::class, 'createUser']);

//update with get method
// Route::get('update/category/{id}/{name}',[RouteController::class, 'updateCategory']);

/**
 *
 * product list
 * localhost:8000/api/product/list (GET)
 *
 * category list
 * localhost:8000/api/category/list (GET)
 *
 * create category
 * localhost:8000/api/create/category (POST)
 * body{
 *     "name":"",
 * }
 *
 * update category
 * localhost:8000/api/update/category (POST)
 *
 * Key
 * ====
 * id => category_id
 * name => category_name
 *
 *
 *
 */
