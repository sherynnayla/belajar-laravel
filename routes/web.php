<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\TodosController;



//auth
Route::middleware('isGuest')->group(function (){
    Route::get('/', [TodosController::class, 'login'])->name('login');
    Route::get('/register', [TodosController::class, 'register']);
    Route::post('/register', [TodosController::class, 'inputRegister'])->name('register.post');
    Route::post('/login', [TodosController::class, 'auth'])->name('login.auth');
});
Route::get('/logout', [TodosController::class, 'logout'])->name('logout');

//todo
    Route::middleware('isLogin')->prefix('/todo')->name('todo.')->group(function (){
    Route::get('/', [TodosController::class, 'index'])->name('index');
    Route::get('/complated', [TodosController::class, 'complated'])->name('complated');
    Route::get('/create', [TodosController::class, 'create'])->name('create');
    Route::post('/store', [TodosController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodosController::class, 'edit'])->name('edit');//{id} untuk 
    Route::patch('/update/{id}', [TodosController::class, 'update'])->name('update');
    Route::delete('/delete/{id}/', [TodosController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}/', [TodosController::class, 'updateComplated'])->name('update-Complated');

 });



