<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegistryController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
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

//Faz login no sistema e gera um novo token
Route::post('/login', [LoginController::class, 'login'])->name('api.loguin');
Route::post('/registry', [RegistryController::class, 'registry'])->name('api.registry');

//Envia um email com o link para resetar a senha do user
Route::post('/mail-reset', [LoginController::class, 'requestPasswordReset'])->name('reset.mail');

//Salva a nova senha do user.
Route::post('/save-password', [ResetPasswordController::class, 'savePassword'])->name('save.password');

//Envia um formulario de redefinição de senha com o id do user incluso.
Route::post('/reset-password', [ResetPasswordController::class, 'resetPasswordForm'])->name('reset.password');

Route::fallback(function () {
    return response()->json(['message' => 'Recurso não encontrado.']);
});
