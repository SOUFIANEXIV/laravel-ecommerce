<?php

use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\RedirectController;
use APP\Http\Controllers\AdminController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


/*route::get('/dashbord',function(){
    return view('dashbord');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\RedirectController::class, 'index'])->name('home');


Auth::routes();

Route::get('/dashbord', [App\Http\Controllers\RedirectController::class, 'redirect'])->name('dashbord');


Route::get('/about', [App\Http\Controllers\RedirectController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\RedirectController::class, 'contact'])->name('contact');


Auth::routes();

Route::get('/redirect', [App\Http\Controllers\RedirectController::class, 'redirect'])->name('redirect');

Auth::routes();

Route::get('/product', [App\Http\Controllers\AdminController::class, 'product'])->name('product');


Route::get('/show_category', [App\Http\Controllers\AdminController::class, 'show_category'])->name('category');

Route::post('/add_category', [App\Http\Controllers\AdminController::class, 'add_category'])->name('add_category');

Route::get('/delete_category/{id}', [App\Http\Controllers\AdminController::class, 'delete_category'])->name('delete_category');

Route::post('/uploadproduct', [App\Http\Controllers\AdminController::class, 'uploadproduct'])->name('uploadproduct');


Route::get('/showproduct', [App\Http\Controllers\AdminController::class, 'showproduct'])->name('showproduct');

Route::get('/deleteproduct/{id}', [App\Http\Controllers\AdminController::class, 'deleteproduct'])->name('deleteproduct');


Route::get('/updateview/{id}', [App\Http\Controllers\AdminController::class, 'updateview'])->name('updateview');

Route::post('/updateproduct/{id}', [App\Http\Controllers\AdminController::class, 'updateproduct'])->name('updateproduct');

Route::get('/search', [App\Http\Controllers\RedirectController::class, 'search'])->name('search');

Route::post('/addcart/{id}', [App\Http\Controllers\RedirectController::class, 'addcart'])->name('addcart');

Route::get('/showcart', [App\Http\Controllers\RedirectController::class, 'showcart'])->name('showcart');

Route::get('/delete/{id}', [App\Http\Controllers\RedirectController::class, 'deletecart'])->name('deletecart');

Route::get('/cash_order', [App\Http\Controllers\RedirectController::class, 'cash_order'])->name('cash_order');

Route::get('/showorder', [App\Http\Controllers\AdminController::class, 'showorder'])->name('showorder');

Route::get('/updatestatus/{id}', [App\Http\Controllers\AdminController::class, 'updatestatus'])->name('updatestatus');

Route::get('/product_details/{id}', [App\Http\Controllers\RedirectController::class, 'product_details'])->name('product_details');

Route::get('/stripe/{total}', [App\Http\Controllers\RedirectController::class, 'stripe'])->name('stripe');

Route::post('/stripe/{total}',[App\Http\Controllers\RedirectController::class, 'stripePost'])->name('stripe.post');

Route::get('/print_pdf/{id}',[App\Http\Controllers\AdminController::class, 'print_pdf'])->name('print_pdf');

Route::get('/send_email/{id}',[App\Http\Controllers\AdminController::class, 'send_email'])->name('send_email');

Route::post('/send_user_email/{id}',[App\Http\Controllers\AdminController::class, 'send_user_email'])->name('send_user_email');

Route::get('/search_admin', [App\Http\Controllers\AdminController::class, 'search_admin'])->name('search_admin');

Route::post('/add_comment', [App\Http\Controllers\RedirectController::class, 'add_comment'])->name('add_comment');

Route::post('/add_reply', [App\Http\Controllers\RedirectController::class, 'add_reply'])->name('add_reply');

Route::get('/delete_comment/{id}', [App\Http\Controllers\RedirectController::class, 'delete_comment'])->name('delete_comment');

Route::get('/delete_reply/{id}', [App\Http\Controllers\RedirectController::class, 'delete_reply'])->name('delete_reply');

Route::post('/subscriber', [App\Http\Controllers\RedirectController::class, 'subscriber'])->name('subscriber');


Route::get('/processpaypal/{total}', [App\Http\Controllers\RedirectController::class, 'processpaypal'])->name('processpaypal');

Route::get('/processSuccess', [App\Http\Controllers\RedirectController::class, 'processSuccess'])->name('processSuccess');

Route::get('/processCancel', [App\Http\Controllers\RedirectController::class, 'processCancel'])->name('processCancel');


Route::get('/location', [App\Http\Controllers\AdminController::class, 'location'])->name('location');

