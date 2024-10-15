<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.home'); 
})->name('pages.home');;

Route::post('/register', [UserController::class,'register'])->name('register.store');;
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.show');
Route::get('/logout', [UserController::class, 'logout'])->name('logoutCustomer');




Route::post('/admin/add-employee', [UserController::class, 'addEmployee'])->name('admin.addEmployee');
Route::delete('/admin/delete-employee/{id}', [UserController::class, 'deleteEmployee'])->name('admin.deleteEmployee');
Route::post('/login', [UserController::class, 'login'])->name('login');
