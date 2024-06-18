<?php

use App\Http\Controllers\Productdashboard;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\Carproducts;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Sales;
use Illuminate\Auth\Events\Login;
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
Route::get('/',[LoginController::class,'login'])->name('login'); //Login Page
Route::get('/signup',[LoginController::class,'index']); //Sign Up Page
Route::post('/saveacc',[LoginController::class,'signupUser']); //Sign Up Page
Route::post('/user/process/login',  [LoginController::class, 'processLogin']);





Route::group(['middleware' => 'auth'], function() {
  // Routes For Users
Route::get('/admindash',[AdminController::class,'admindashboardview'])->name('admin');//admin dashboard
Route::get('/userstable',[AdminController::class,'usersTable']);//View User Table with Data form Database

Route::get('/viewuser/{id}',[AdminController::class,'userTableview']);//View selected User from user Table

Route::get('/edituser/{id}',[AdminController::class,'edituser']);//View Edit User Page
Route::put('/user/update/{id}', [AdminController::class, 'updateUser'])->name('user.update');//Update user to Database Function
Route::get('/users', [AdminController::class, 'searchUser'])->name('adminside.usertable');// Search user

Route::get('/deleteuser/{id}',[AdminController::class,'deleteUser']);//to View delete user Page
Route::delete('/user/destroy/{user}', [AdminController::class, 'destroy'])->name('user.destroy');//Delete Data in Database

Route::get('/delusers',[AdminController::class,'deletedindex']);//View Deleted user Table
Route::get('/restore-user/{id}', [AdminController::class,'restore'])->name('user.restore');
Route::get('/delete-user/{id}', [AdminController::class,'delete'])->name('user.delete');



//Routes for Parts Type
Route::get('/partstypetable',[PartsController::class,'partsTypetable']);//to View PartsTypeTable
Route::post('/addpartsType',[PartsController::class,'storePartType']);//Add Part Type to the Database
Route::put('/partstype/{id}', [PartsController::class, 'update'])->name('partstype.update');//Edit Parttype in DB
Route::delete('/partstype/{id}', [PartsController::class, 'destroytype'])->name('partstype.destroy');


//Routes for Parts Product
Route::get('/partstable',[PartsController::class,'partsTable'])->name('partstable');// to View the Parts Table
Route::get('/addpartproduct',[PartsController::class,'addProductpage']);//View Add Product Page
Route::post('/addpart', [PartsController::class, 'addpartProduct'])->name('parts.add');// Add Product to Database
Route::get('/partsview/{id}', [PartsController::class, 'partsTableview'])->name('parts.view');//  View Specific Partproduct Data

Route::get('/editpartspage/{id}',[PartsController::class,'editpartPage']);//To View Edit Parts Page
Route::put('/parts/{id}', [PartsController::class, 'updateProducts'])->name('parts.update');//Update Product to Database

Route::get('/deletepartspage/{id}',[PartsController::class,'deletepartPage']);//To View Delete Parts Page
Route::delete('/parts/{part}', [PartsController::class, 'destroy'])->name('parts.destroy');//Delete Part products in Database

//Routes for Car Products
Route::get('/carstable',[Carproducts::class,'carTable'])->name('carstable');
Route::post('/cars/add', [Carproducts::class, 'addCarProduct'])->name('cars.add');//ADD Product to Database
Route::get('/carproducts/edit/{id}', [Carproducts::class, 'edit'])->name('carproducts.edit');
Route::put('/carproducts/update/{id}', [Carproducts::class, 'update'])->name('carproducts.update');
Route::delete('/carproducts/delete/{id}', [Carproducts::class, 'destroy'])->name('carproducts.destroy');
Route::get('/carproducts/search', [Carproducts::class, 'search'])->name('carproducts.search');




//Routes for POS DASHBOARD
Route::get('/posdashboard',[PosController::class,'Posmaindash'])->name('posdashboard');//To View All Car Products
Route::get('/car/{id}', [PosController::class, 'show'])->name('car.show');//to View Specific Product
Route::post('/car/buy/{id}', [PosController::class, 'saveSales'])->name('car.sales');// For saving the data that is bought
Route::post('/car/buy', [PosController::class, 'buy'])->name('car.buy');//To view product before buying

Route::get('/partsdashboard',[PosController::class,'Pospartsdash'])->name('partsdashboard');//To view the Parts Dashboard

Route::post('/cart/add', [PosController::class, 'addToCart']);
Route::post('/cart/remove', [PosController::class, 'removeFromCart']);
Route::get('/cart', [PosController::class, 'getCart']);

Route::get('/checkout',  [PosController::class, 'partscheckout'])->name('checkout');
Route::post('/compute-change',  [PosController::class, 'computeChange'])->name('computeChange');
Route::post('/generate-receipt', [PosController::class,'generateReceipt'])->name('generateReceipt');


Route::get('/sales', [Sales::class,'salesIndex']);

Route::get('/logout', [LoginController::class,'anotherProcessLogout'])->name('logout');


});





