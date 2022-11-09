<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\TodosController;


Route::get('/', [TodosController::class, 'login']);
