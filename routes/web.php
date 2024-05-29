<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminPostCategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminSellController;
use App\Http\Controllers\Admin\AdminSizeController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login/handle', [LoginController::class, 'handle'])->name('login.handle');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//Register
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/handle', [RegisterController::class, 'handle'])->name('register.handle');
Route::get('register/active/{remember_token}', [RegisterController::class, 'active'])->name('register.active');

//Reset Password
Route::get('reset', [LoginController::class, 'reset'])->name('reset.pass');
Route::post('active/{reset_token}', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('new-pass/{reset_token}', [LoginController::class, 'newPass'])->name('new.pass');
Route::post('new-pass/{reset_token}', [LoginController::class, 'updatePass'])->name('update.pass');



Route::middleware(['auth', 'role:Member'])->group(function () {
    Route::get('member', [MemberController::class, 'index'])->name('member');
    Route::post('member/update', [MemberController::class, 'update'])->name('member.update');
});

Route::middleware(['auth', 'checkAdminRole'])->group(function () {
    #ADMIN
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Page 
    Route::get('admin/page', [AdminPageController::class, 'list'])->middleware('can:page.view');
    Route::get('admin/page/add', [AdminPageController::class, 'add'])->name('page.add')->middleware('can:page.add');
    Route::post('admin/page/store', [AdminPageController::class, 'store'])->name('page.store')->middleware('can:page.add');
    Route::get('admin/page/edit/{id}', [AdminPageController::class, 'edit'])->name('page.edit')->middleware('can:page.edit');
    Route::post('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('page.update')->middleware('can:page.edit');
    Route::get('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('page.delete')->middleware('can:page.delete');
    //PostCategory
    Route::get('admin/post/cat', [AdminPostCategoryController::class, 'list'])->middleware('can:post.view');
    Route::get('admin/post/cat/add', [AdminPostCategoryController::class, 'add'])->name('post_category.add')->middleware('can:post.add');
    Route::post('admin/post/cat/store', [AdminPostCategoryController::class, 'store'])->name('post_category.store')->middleware('can:post.add');
    Route::get('admin/post/cat/edit/{id}', [AdminPostCategoryController::class, 'edit'])->name('post_category.edit')->middleware('can:post.edit');
    Route::post('admin/post/cat/update/{id}', [AdminPostCategoryController::class, 'update'])->name('post_category.update')->middleware('can:post.edit');
    Route::get('admin/post/cat/delete/{id}', [AdminPostCategoryController::class, 'delete'])->name('post_category.delete')->middleware('can:post.delete');
    //Post
    Route::get('admin/post', [AdminPostController::class, 'list'])->middleware('can:post.view');
    Route::get('admin/post/add', [AdminPostController::class, 'add'])->name('post.add')->middleware('can:post.add');
    Route::post('admin/post/store', [AdminPostController::class, 'store'])->name('post.store')->middleware('can:post.add');
    Route::get('admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('post.edit')->middleware('can:post.edit');
    Route::post('admin/post/update/{id}', [AdminPostController::class, 'update'])->name('post.update')->middleware('can:post.edit');
    Route::get('admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('post.delete')->middleware('can:post.delete');  

    //ProductCategory
    Route::get('admin/product/cat', [AdminProductCategoryController::class, 'list'])->middleware('can:product.view');
    Route::get('admin/product/cat/add', [AdminProductCategoryController::class, 'add'])->name('product_category.add')->middleware('can:product.add');
    Route::post('admin/product/cat/store', [AdminProductCategoryController::class, 'store'])->name('product_category.store')->middleware('can:product.add');
    Route::get('admin/product/cat/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('product_category.edit')->middleware('can:product.edit');
    Route::post('admin/product/cat/update/{id}', [AdminProductCategoryController::class, 'update'])->name('product_category.update')->middleware('can:product.edit');
    Route::get('admin/product/cat/delete/{id}', [AdminProductCategoryController::class, 'delete'])->name('product_category.delete')->middleware('can:product.delete');
    //Size
    Route::get('admin/size/add', [AdminSizeController::class, 'add'])->middleware('can:product.add');
    Route::post('admin/size/store', [AdminSizeController::class, 'store'])->name('size.store')->middleware('can:product.add');
    //Product
    Route::get('admin/product', [AdminProductController::class, 'list'])->middleware('can:product.view');
    Route::post('admin/product', [AdminProductController::class, 'action'])->name('product.action')->middleware('can:product.view');
    Route::get('admin/product/add', [AdminProductController::class, 'add'])->name('product.add')->middleware('can:product.add');
    Route::post('admin/product/store', [AdminProductController::class, 'store'])->name('product.store')->middleware('can:product.add');
    Route::get('admin/product/edit/{id}', [AdminProductController::class, 'edit'])->name('product.edit')->middleware('can:product.edit');
    Route::post('admin/product/update/{id}', [AdminProductController::class, 'update'])->name('product.update')->middleware('can:product.edit');
    Route::get('admin/product/delete/{id}', [AdminProductController::class, 'delete'])->name('product.delete')->middleware('can:product.delete');
    //Slider
    Route::get('admin/slider', [AdminSliderController::class, 'list'])->middleware('can:slider.view');
    Route::get('admin/slider/add', [AdminSliderController::class, 'add'])->name('slider.add')->middleware('can:slider.add');
    Route::post('admin/slider/store', [AdminSliderController::class, 'store'])->name('slider.store')->middleware('can:slider.add');
    Route::get('admin/slider/edit/{id}', [AdminSliderController::class, 'edit'])->name('slider.edit')->middleware('can:slider.edit');
    Route::post('admin/slider/update/{id}', [AdminSliderController::class, 'update'])->name('slider.update')->middleware('can:slider.edit');
    Route::get('admin/slider/delete/{id}', [AdminSliderController::class, 'delete'])->name('slider.delete')->middleware('can:slider.delete');
    //Sell
    Route::get('admin/sell', [AdminSellController::class, 'index'])->name('sell.index')->middleware('can:sell.order');
    Route::get('admin/sell/customer', [AdminSellController::class, 'customer'])->name('sell.customer')->middleware('can:sell.customer');
    Route::get('admin/sell/detail-order/{id}', [AdminSellController::class, 'detailOrder'])->name('sel.detailOrder')->middleware('can:sell.detail');
    Route::post('admin/update-status/{id}', [AdminSellController::class, 'updateStatus'])->name('update.status')->middleware('can:sell.detail');
    Route::get('admin/print-bill/{id}', [AdminSellController::class, 'printBill'])->name('printBill')->middleware('can:sell.detail');
    //User
    Route::get('admin/user', [AdminUserController::class, 'list'])->middleware('can:admin.manager.user');
    Route::get('admin/user/action', [AdminUserController::class, 'action'])->name('user.action')->middleware('can:admin.manager.user');
    Route::get('admin/user/add', [AdminUserController::class, 'add'])->name('user.add')->middleware('can:admin.manager.user');
    Route::post('admin/user/store', [AdminUserController::class, 'store'])->name('user.store')->middleware('can:admin.manager.user');
    Route::get('admin/user/edit/{user}', [AdminUserController::class, 'edit'])->name('user.edit')->middleware('can:admin.manager.user');
    Route::post('admin/user/update/{user}', [AdminUserController::class, 'update'])->name('user.update')->middleware('can:admin.manager.user');
    Route::get('admin/user/delete/{user}', [AdminUserController::class, 'delete'])->name('user.delete')->middleware('can:admin.manager.user');
    //Permission
    Route::get('admin/permission/add', [AdminPermissionController::class, 'add'])->name("permission.add")->middleware('can:admin.authorization');
    Route::post('admin/permission/store', [AdminPermissionController::class, 'store'])->name("permission.store")->middleware('can:admin.authorization');
    Route::get('admin/permission/edit/{id}', [AdminPermissionController::class, 'edit'])->name('permission.edit')->middleware('can:admin.authorization');
    Route::post('admin/permission/update/{id}', [AdminPermissionController::class, 'update'])->name('permission.update')->middleware('can:admin.authorization');
    Route::get('admin/permission/delete/{id}', [AdminPermissionController::class, 'delete'])->name('permission.delete')->middleware('can:admin.authorization');
    //Role
    Route::get('admin/role', [AdminRoleController::class, 'index'])->name('role.index')->middleware('can:admin.authorization');
    Route::get('admin/role/action', [AdminRoleController::class, 'action'])->name('role.action')->middleware('can:admin.authorization');
    Route::get('admin/role/add', [AdminRoleController::class, 'add'])->name('role.add')->middleware('can:admin.authorization');
    Route::post('admin/role/store', [AdminRoleController::class, 'store'])->name('role.store')->middleware('can:admin.authorization');
    Route::get('admin/role/edit/{role}', [AdminRoleController::class, 'edit'])->name('role.edit')->middleware('can:admin.authorization');
    Route::post('admin/role/update/{role}', [AdminRoleController::class, 'update'])->name('role.update')->middleware('can:admin.authorization');
    Route::get('admin/role/delete/{role}', [AdminRoleController::class, 'delete'])->name('role.delete')->middleware('can:admin.authorization');
});


//Front
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('san-pham/', [FrontendController::class, 'listProduct'])->name('list');
Route::get('san-pham/{slug}', [FrontendController::class, 'detailProduct'])->name('detail');
Route::get('san-pham/hang/{name}', [FrontendController::class, 'categoryProduct'])->name('product.category');
Route::get('trang/{slug}', [FrontendController::class, 'page'])->name('page');
Route::get('bai-viet', [FrontendController::class, 'post'])->name('post');
Route::get('bai-viet/{slug}', [FrontendController::class, 'postDetail'])->name('post.detail');

Route::get('checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('rqCheckout', [FrontendController::class, 'rqCheckout'])->name('rqCheckout');

Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
