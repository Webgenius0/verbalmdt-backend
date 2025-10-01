<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Blogs\BlogApiController;
use App\Http\Controllers\API\ContactUs\ContactController;
use App\Http\Controllers\API\PrivacyPolicy\PrivacyPolicyController;
use App\Http\Controllers\API\Terms\TermController;
use Illuminate\Support\Facades\Route;


// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Logged-in user routes (sanctum protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('password/request-otp', [AuthController::class, 'requestOtp']);
    Route::post('password/verify-otp', [AuthController::class, 'verifyOtpAndUpdate']);
});

// Forgot password (no login required)
Route::post('password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);
Route::post('password/verify-otp', [AuthController::class, 'verifyOtpForgotPassword']);

//cms
Route::apiResource('contacts', ContactController::class);
Route::get('contact-images', [ContactController::class, 'imagesGet']);
Route::get('/terms', [TermController::class, 'index']);
Route::get('/privacy-policies', [PrivacyPolicyController::class, 'index']);


Route::apiResource('/api-blogs', BlogApiController::class);
