<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Blogs\BlogController;
use App\Http\Controllers\Web\CMS\PrivacyPolicyController;
use App\Http\Controllers\Web\CMS\TermsController;
use App\Http\Controllers\Web\ContactUS\ContactImageController;
use App\Http\Controllers\Web\ContactUS\ContactWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Terms and conditions

Route::resource('web-terms', TermsController::class);
Route::resource('web-privacy-policies', PrivacyPolicyController::class);

//contact Us
Route::get('/contacts', [ContactWebController::class, 'index'])->name('contacts.web.index');
//contact-image-upload
Route::resource('web-contact-images', ContactImageController::class);

//cms/blogs
Route::resource('blogs', BlogController::class);



require __DIR__.'/auth.php';
