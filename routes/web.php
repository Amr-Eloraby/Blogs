<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeController;
use App\Models\Contact;
use App\Models\Subscriber;
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

Route::controller(ThemeController::class)->name('theme.')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');
});

Route::post('/subsciber/store',[SubscriberController::class,'store'])->name('subscriber.store');

Route::post('/contact/store',[ContactController::class,'store'])->name('contact.store');

Route::get('/my-blogs',[BlogController::class,'myBlog'])->name('bloge.my-blog');
Route::resource('blogs',BlogController::class)->except('index');

Route::post('/comment/store',[CommentController::class,'store'])->name('comment.store');


require __DIR__.'/auth.php';
