<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SocialiteController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// routes/web.php

// ---------- Theme Routes ----------
Route::controller(ThemeController::class)->name('theme.')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');
});

// ---------- Subscriber Store Route => form in sidebar && Footer --------
Route::post('subscriber/store',[SubscriberController::class,'store'])->name('subscriber.store');

// ---------- Contact Store Route => form in Contact Page ------------
Route::post('contact/store',[ContactController::class,'store'])->name('contact.store');

// ---------- Blog Routes ------------
Route::get('/myblogs',[ BlogController::class,'myblogs'])->name('blog.myblogs');
#### Blog CRUD Routes => Create, Store, Edit, Update, Destroy
Route::resource('blog', BlogController::class)->except('index');


// ---------- comments Routes ---------
Route::post('/comment/store',[ CommentController::class,'store'])->name('comment.store');

//---------- Socialite Routes -----------
Route::prefix('google')->name('socialite.')->controller(SocialiteController::class)->group(function(){

    Route::get('/login', 'login')->name('login');
    Route::get('/redirect', 'redirect')->name('redirect');

});


require __DIR__.'/auth.php';
