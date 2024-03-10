<?php

declare(strict_types=1);

use App\Http\Controllers\V1\ConverterController;
use App\Http\Controllers\V1\CustomFileController;
use Illuminate\Support\Facades\Route;

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

Route::get('files/{file}/convert', [ConverterController::class, 'convert']);
Route::apiResource('files', CustomFileController::class);
