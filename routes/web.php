<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TestimonialController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
//user
Route::get('admin/users',[UserController::class,'index'])->name('allusers');
Route::get('admin/user/add',[UserController::class,'create'])->name('adduser');
Route::post('admin/user/store',[UserController::class,'store'])->name('storeuser');
Route::get('admin/users/edit/{id}',[UserController::class,'edit']);
Route::put('admin/users/update/{id}', [UserController::class, 'update'])->name('updateUser');

//category
Route::get('admin/categories',[CategoryController::class,'index'])->name('allcategories');
Route::get('admin/category/add',[CategoryController::class,'create'])->name('addcategory');
Route::post('admin/category/store',[CategoryController::class,'store'])->name('storecategory');
Route::get('admin/categories/edit/{id}',[CategoryController::class,'edit']);
Route::put('admin/categories/update/{id}', [CategoryController::class, 'update'])->name('updateCategory');
Route::get('admin/categories/delete/{id}',[CategoryController::class,'destroy']);


//cars
Route::get('admin/cars',[CarController::class,'index'])->name('allcars');
Route::get('admin/car/add',[CarController::class,'create'])->name('addcar');
Route::post('admin/car/store',[CarController::class,'store'])->name('storecar');

//testimonials
Route::get('admin/testimonials',[TestimonialController::class,'index']);
Route::get('admin/testimonial/add',[TestimonialController::class,'create'])->name('addtestimonial');
Route::post('admin/testimonial/store',[TestimonialController::class,'store'])->name('storetestimonial');



//website
Route::view('/blo','main/blog');
Route::view('/abo','main/about');
