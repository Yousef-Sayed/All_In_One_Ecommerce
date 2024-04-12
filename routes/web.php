<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryControllerUser;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsUserController;
use App\Http\Controllers\ProdecutController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TestimonialController;


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.index');
})->name('homePage');

// Prodecut routes
Route::prefix('prodecut')->group(function () {
    Route::get('/showAll', [ProdecutController::class, 'showAll'])->name('showAllPro');
    Route::get('/show', [ProdecutController::class, 'show'])->name('show');
});
Route::get('/showAllProdectInCategoty/{id}', [CategoryControllerUser::class, 'show1'])->name('show.category');



// ============================ Auth User ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware(['checkLogin'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::get('/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::post('/forgot', [AuthController::class, 'forgot_password'])->name('forgot.password');
Route::get('/forgot/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('/forgot/changePassword', [AuthController::class, 'UpdatePassword'])->name('changePass');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [HomeController::class, 'profile'])->middleware(['profile'])->name('profileUser');
Route::post('/signup/user', [AuthController::class, 'signupUser'])->name('signup.user');
Route::post('/login/user', [AuthController::class, 'loginUser'])->name('login.user');
Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('profileUpdate');
Route::get('/testimonial', [TestimonialController::class, 'index'])->middleware(['auth:web'])->name('testimonial');
Route::post('/testimonial', [TestimonialController::class, 'storeTestimonial'])->middleware(['auth:web'])->name('store.Testimonial');
Route::get('/yourCart', [CartController::class, 'index'])->middleware(['auth:web'])->name('cart.index');
Route::get('/addCart/{id}', [CartController::class, 'add'])->middleware(['auth:web'])->name('cart.add');
Route::put('/updateCart', [CartController::class, 'update'])->middleware(['auth:web'])->name('cart.update');
Route::get('/reomveCart/{id}', [CartController::class, 'reomve'])->middleware(['auth:web'])->name('cart.reomve');
Route::get('/checkout', [CartController::class, 'checkout'])->middleware(['auth:web'])->name('cart.checkout');
Route::resource('/news-read', NewsUserController::class)->middleware(['auth:web']);
Route::get('/news-comment/{delete}', [CommentController::class,'delete'])->middleware(['auth:web'])->name('comment.delete');
Route::resource('/news-comment', CommentController::class)->middleware(['auth:web']);
Route::get('/news-reply/{delete}', [ReplyController::class,'delete'])->middleware(['auth:web'])->name('reply.delete');
Route::resource('/news-reply', ReplyController::class)->middleware(['auth:web']);
// In your routes/web.php file
Route::get('/update-content/{id}', [CartController::class, 'updateContent'])->name('shippingValueUpdate');
Route::post('/createOrder', [CartController::class, 'crateOrder'])->name('createOrder');

// Socialite routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [SocialiteController::class, 'redirectToGoogle'])->name('AG');
    Route::get('/google/callback', [SocialiteController::class, 'hendelGoogleCallback']);
    Route::get('/facebook', [SocialiteController::class, 'redirectToFacebook'])->name('AF');
    Route::get('/facebook/callback', [SocialiteController::class, 'hendelFacebookCallback']);
});
// =========================== Languages ==========================================
Route::get('/lang/{lang}',[LanguageController::class,'change'])->name('langg');

