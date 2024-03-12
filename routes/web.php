<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;




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
//frontend
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');

//trang liên hệ
Route::get('/lien-he', [ContactController::class, 'lien_he']);


//send email
Route::get('/send-email', [HomeController::class, 'send_email']);

//login facebook
Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

//tim kiem

Route::post('/tim-kiem', [HomeController::class, 'search']);

Route::post('/tim-kiem-ajax', [HomeController::class, 'tim_kiem_ajax']);


//danh muc san pham trang chu

Route::get('/danh-muc/{slug}', [HomeController::class, 'show']);

Route::post('/product-tabs', [HomeController::class, 'product_tabs']);


//danh muc bai viet san pham trang chu
Route::get('/danh-muc-bai-viet/{slug}', [HomeController::class, 'show_cate_post']);
Route::get('/bai-viet/{slug}', [HomeController::class, 'post']);

//thuong hieu san pham trang chu
Route::get('/thuong-hieu/{slug}', [HomeController::class, 'show_brand']);

//chi tiet san pham trang chu
Route::get('/chi-tiet/{slug}', [HomeController::class, 'show_details_product']);

//tags
Route::get('/tag/{tag}', [HomeController::class, 'tag']);

//xem nhanh

Route::post('/quickview', [HomeController::class, 'quickview']);

// load comment bình luận 

Route::post('/load-comment', [HomeController::class, 'load_comment']);

//gửi bình luận 
Route::post('/send-comment', [HomeController::class, 'send_comment']);

//gửi đánh giá sao 
Route::post('/insert-rating', [HomeController::class, 'insert_rating']);


//Gio Hang
Route::post('/save-cart', [CartController::class, 'create']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);

Route::get('/show-cart', [CartController::class, 'index']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);

Route::get('/delete-to-cart/{rowID}', [CartController::class, 'destroy']);
Route::post('/update-cart-qty', [CartController::class, 'edit']);

Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::get('/deleted-product/{session_id}', [CartController::class, 'deleted_product']);

Route::get('/delete-all-product', [CartController::class, 'delete_all_product']);

//checkout
Route::post('/login-customer', [CheckoutController::class, 'login']);

Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);

Route::post('/add-customer', [CheckoutController::class, 'store']);

Route::get('/checkout', [CheckoutController::class, 'checkout']);

Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);

Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/order-place', [CheckoutController::class, 'order_place']);

Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);

//phi van chuyen home

Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);

Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);

Route::get('/delete-fee', [CheckoutController::class, 'delete_fee']);


//Coupon Mã Giảm Giá
Route::post('/check-coupon', [CouponController::class, 'check_coupon']);
Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
Route::post('/save-coupon', [CouponController::class, 'store_coupon']);

Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/delete-coupon/{id}',[CouponController::class, 'destroy']);
Route::get('/unset-coupon',[CouponController::class, 'unset_coupon']);




//Admin
Route::get('/admin', [AdminController::class, 'login']);
Route::get('/dashboard', [AdminController::class, 'index']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//category
Route::get('/add-category', [CategoryController::class, 'create']);
Route::get('/list-category', [CategoryController::class, 'index']);
Route::post('/save-category',[CategoryController::class, 'store']);
Route::get('/edit-category/{id}',[CategoryController::class, 'edit']);
Route::post('/update-category/{id}',[CategoryController::class, 'update']);
Route::get('/delete-category/{id}',[CategoryController::class, 'destroy']);

Route::get('/unactive-category/{id}', [CategoryController::class, 'unactive']);
Route::get('/active-category/{id}', [CategoryController::class, 'active']);

Route::post('/import-csv',[CategoryController::class, 'import_csv']);
Route::post('/export-csv',[CategoryController::class, 'export_csv']);

// sắp xếp danh mục
Route::post('/array-category',[CategoryController::class, 'array_category']);


//danh mục bài viết

Route::get('/list-cate-post', [CategoryPostController::class, 'list_cate_post']);

Route::get('/add-cate-post', [CategoryPostController::class, 'add_cate_post']);

Route::get('/edit-cate-post/{id}', [CategoryPostController::class, 'edit_cate_post']);

Route::post('/save-cate-post', [CategoryPostController::class, 'save_cate_post']);

Route::post('/update-cate-post/{id}', [CategoryPostController::class, 'update_cate_post']);

Route::get('/delete-cate-post/{id}', [CategoryPostController::class, 'delete_cate_post']);

//bai viet
Route::get('/list-post', [PostController::class, 'list_post']);

Route::get('/add-post', [PostController::class, 'add_post']);

Route::get('/edit-post/{id}', [PostController::class, 'edit_post']);

Route::get('/delete-post/{id}', [PostController::class, 'delete_post']);

Route::post('/save-post', [PostController::class, 'save_post']);

Route::post('/update-post/{id}', [PostController::class, 'update_post']);


//brand
Route::get('/add-brand', [BrandController::class, 'create']);
Route::get('/list-brand', [BrandController::class, 'index']);
Route::post('/save-brand',[BrandController::class, 'store']);
Route::get('/edit-brand/{id}',[BrandController::class, 'edit']);
Route::post('/update-brand/{id}',[BrandController::class, 'update']);
Route::get('/delete-brand/{id}',[BrandController::class, 'destroy']);

Route::get('/unactive-brand/{id}', [BrandController::class, 'unactive']);
Route::get('/active-brand/{id}', [BrandController::class, 'active']);

//product





Route::get('/add-product', [ProductController::class, 'create']);
Route::get('/list-product', [ProductController::class, 'index']);
Route::post('/save-product',[ProductController::class, 'store']);
Route::get('/edit-product/{id}',[ProductController::class, 'edit']);
Route::post('/update-product/{id}',[ProductController::class, 'update']);
Route::get('/delete-product/{id}',[ProductController::class, 'destroy']);

Route::get('/unactive-product/{id}', [ProductController::class, 'unactive']);
Route::get('/active-product/{id}', [ProductController::class, 'active']);

//Đơn hàng order


Route::get('/manage-order', [OrderController::class, 'manage_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);

Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
Route::post('/update-qty', [OrderController::class, 'update_qty']);

//lọc đơn hàng
Route::get('/loc-order', [OrderController::class, 'loc_order']);

// Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
// Route::get('/view-order/{id}', [CheckoutController::class, 'show']);

//QL vận chuyển delivery
Route::get('/delivery', [DeliveryController::class, 'add_delivery']);

Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery']);
Route::post('/list-delivery', [DeliveryController::class, 'list_delivery']);
Route::post('/update-feeship', [DeliveryController::class, 'update_feeship']);

//banner

Route::get('/list-banner', [BannerController::class, 'list_banner']);

Route::get('/manade-banner', [BannerController::class, 'manade_banner']);
Route::post('/save-slider', [BannerController::class, 'save_slider']);

Route::get('/unactive-slider/{id}', [BannerController::class, 'unactive']);
Route::get('/active-slider/{id}', [BannerController::class, 'active']);

Route::get('/delete-slider/{id}',[BannerController::class, 'delete_slider']);

//quen mat khau forgot password
Route::get('/forgot-password',[AuthController::class, 'forgot_password']);
Route::post('/forgot',[AuthController::class, 'forgot']); 
Route::post('/comfirm', [AuthController::class, 'comfirm']);
Route::post('/create-new-password', [AuthController::class, 'create_new_password']);

// Phan quyen

Route::get('/register-auth',[AuthController::class, 'register_auth']); 

Route::get('/login-auth',[AuthController::class, 'login_auth']); 
Route::get('/logout-auth',[AuthController::class, 'logout_auth']); 

Route::post('/register',[AuthController::class, 'register']); 

Route::post('/login',[AuthController::class, 'login']); 


//user
Route::get('/users',[UserController::class, 'index']);

//chuyen user
Route::get('/impersonate-destroy',[UserController::class, 'impersonate_destroy']); 

Route::get('/delete-user/{id}',[UserController::class, 'delete_user']);

Route::get('/impersonate/{id}',[UserController::class, 'impersonate']);

Route::post('/assign-roles',[UserController::class, 'assign_roles']);


Route::post('/insert-user',[UserController::class, 'store_users']);

//quan ly duong dan bang middleware
Route::group(['middleware' => 'auth.roles'] , function () {
	Route::get('/add-user',[UserController::class, 'add_user']); 

});

//gallery
Route::get('/add-gallery/{id}',[GalleryController::class, 'add_gallery']);

Route::post('/select-gallery',[GalleryController::class, 'select_gallery']);

Route::post('/insert-gallery/{id}',[GalleryController::class, 'insert_gallery']);

Route::post('/update-gallery-name',[GalleryController::class, 'update_gallery_name']);

Route::post('delete-gallery',[GalleryController::class, 'delete_gallery']);

Route::post('update-gallery',[GalleryController::class, 'update_gallery']);
//duyêt bình luận 

Route::get('/list-comment',[ProductController::class, 'list_comment']);

Route::post('duyet-comment',[ProductController::class, 'duyet_comment']);

Route::post('reply-comment',[ProductController::class, 'reply_comment']);

// thông tin trang web
Route::get('/information',[ContactController::class, 'information']);

Route::post('save-info',[ContactController::class, 'save_info']);

Route::post('update-info/{id}',[ContactController::class, 'update_info']);

//dashboard lọc ngày 

Route::post('filter-by-date',[AdminController::class, 'filter_by_date']);

Route::post('days-order',[AdminController::class, 'days_order']);

Route::post('dashboard-filter',[AdminController::class, 'dashboard_filter']);