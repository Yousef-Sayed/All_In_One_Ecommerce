<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\DeletedController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProdecutController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\Admin\TestimoialController;
use App\Http\Controllers\admin\auth\AdminLoginController;
use App\Http\Controllers\admin\auth\AdminRegisterController;
use App\Http\Controllers\admin\logsController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\OrderController;

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    Route::get ('/admin', [AdminHomeController::class, 'index'])->name('admin.home');
    Route::get ('/profile', [AdminHomeController::class, 'profile'])->name('admin.profile');

    // ===================================== Category Route  ================================
    Route::get ('/category/deleted/', [CategoryController::class, 'deleted'])->name('category.deleted');
    Route::get ('/category/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get ('/category/permanentDeletion/{id}', [CategoryController::class, 'permanentDeletion'])->name('category.permanentDeletion');
    Route::resource('/category', CategoryController::class);

    // ===================================== Prodeuct Route ================================
    Route::get ('/prodecut/deleted/', [ProdecutController::class, 'deleted'])->name('prodecut.deleted');
    Route::get ('/prodecut/restore/{id}', [ProdecutController::class, 'restore'])->name('prodecut.restore');
    Route::get ('/prodecut/permanentDeletion/{id}', [ProdecutController::class, 'permanentDeletion'])->name('prodecut.permanentDeletion');
    Route::resource('/prodecut', ProdecutController::class);
    Route::get ('/users', [UserController::class, 'index'])->name('users');
    Route::delete ('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/profile/update', [AdminHomeController::class, 'updateProfileAdmin'])->name('profileUpdateAdmin');

    // ===================================== News Route ================================
    Route::post ('/news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get ('/news/deleted/', [NewsController::class, 'deleted'])->name('news.deleted');
    Route::get('/news/active/{value}', [NewsController::class,'Active'])->name('news.active');
    Route::get('/news/disActive/{value}', [NewsController::class,'disActive'])->name('news.disAvtive');
    Route::get('/news/restore/{id}', [NewsController::class,'restore'])->name('news.restore');
    Route::get('/news/permanentDeletion/{id}', [NewsController::class,'permanentDeletion'])->name('news.permanentDeletion');
    Route::resource('/news', NewsController::class);
    // ===================================== Admin Route ================================
    Route::middleware('can:show')->group(function () {
        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
        Route::get('/admins/active/{id}', [AdminController::class, 'active'])->name('admins.avtive');
        Route::get('/admins/disActive/{id}', [AdminController::class, 'disAvtive'])->name('admins.disAvtive');
        Route::post('/admins/deleteAdmin/{id}', [AdminController::class, 'delete'])->name('admins.deleteAdmin');
        Route::get('/registerWithAdmin', [AdminRegisterController::class, 'registerWithAdmin'])->name('admin.registerWithAdmin');
        Route::post('/registerWithAdmin', [AdminRegisterController::class, 'sroreWithAdmin'])->name('admin.register.postWithAdmin');
    });
    // ===================================== Testimonial Route ================================
    Route::get('/testimonial', [TestimoialController::class, 'index'])->name('admin.testimonial');
    Route::get('/testimonial/active/{id}', [TestimoialController::class, 'active'])->name('admin.testimonial.avtive');
    Route::get('/testimonial/disActive/{id}', [TestimoialController::class, 'disAvtive'])->name('admin.testimonial.disAvtive');
    Route::post('/testimonial/deleteTestimonial/{id}', [TestimoialController::class, 'delete'])->name('admin.testimonial.deleteTestimonial');
    // Route::get('/deleted', [DeletedController::class, 'index'])->name('admin.deleted');

    // ===================================== Logs Route ================================
    Route::resource('/logs', logsController::class);
    // ===================================== Shipping Route ===================================
    Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping.index');
    Route::get('/shipping/add', [ShippingController::class, 'add'])->name('shipping.add');
    Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
    Route::get('/shipping/edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
    Route::put('/shipping/edit', [ShippingController::class, 'update'])->name('shipping.update');
    Route::delete('/shipping/delete/{id}', [ShippingController::class, 'delete'])->name('shipping.delete');

    // ===================================== Order Route ===================================
    Route::post('/order/{delete}',[OrderController::class,'delete'])->name('orders.deletess');
    Route::resource('/orders',OrderController::class);
});
Route::get('/lang/{lang}',[LanguageController::class,'change'])->name('langg');
// =========================== Auth Admin  ==========================================
Route::get ('admin/login', [AdminLoginController::class, 'index'])->name('admin.login')->middleware('checkLoginAdmin');
Route::post ('admin/login', [AdminLoginController::class, 'checkLogin'])->name('admin.login.post');
Route::get('admin/forgot', [AdminLoginController::class, 'forgot'])->name('admin.forgot');
Route::post('admin/forgot', [AdminLoginController::class, 'forgot_password'])->name('admin.forgot.password');
Route::get('admin/forgot/{token}', [AdminLoginController::class, 'reset'])->name('resetAdmin');
Route::post('admin/forgot/changePassword', [AdminLoginController::class, 'UpdatePassword'])->name('admin.changePass');
Route::get ('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get ('admin/register', [AdminRegisterController::class, 'index'])->name('admin.register');
Route::post ('admin/register', [AdminRegisterController::class, 'store'])->name('admin.register.post');
Route::get ('admin/VerificationEmail/{email} ', [AdminRegisterController::class, 'verificationEmail'])->name('admin.VerificationEmail');
Route::get ('admin/verified/{email} ', [AdminRegisterController::class, 'verified'])->name('admin.verified');

