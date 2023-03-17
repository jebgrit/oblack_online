<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorTicketController;
use App\Http\Controllers\Backend\ConversationController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Fronted\IndexController;
use App\Http\Controllers\Fronted\CartController;
use App\Http\Controllers\Fronted\ContactController;
use App\Http\Controllers\Fronted\HomeController;
use App\Http\Controllers\Fronted\NewsletterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishlistController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

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



Route::get('/', [IndexController::class, 'index'])->name('home');

// Home
Route::controller(HomeController::class)->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/term', 'term')->name('term');
    Route::get('/cgv', 'cgv')->name('cgv');
    Route::get('/legal', 'legalNotice')->name('legal');
    Route::get('/faq', 'faq')->name('faq');
});

// Vendor register
Route::get('/become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');

// password reset
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');




Route::middleware(['auth', 'role:admin', 'role:vendor'])->group(function () {

    // Message
    Route::post('/conversation', [ConversationController::class, 'conversation'])->name('conversation');
});


















/*
|--------------------------------------------------------------------------
| Admin all routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::controller(HomeController::class)->group(function () {

        Route::get('/all/faq', 'faqAll')->name('faq.all');
        Route::get('/faq/new', 'faqNew')->name('faq.new');
        Route::post('/faq/store', 'faqStore')->name('faq.store');
        Route::get('/faq/delete/{id}', 'faqDelete')->name('faq.delete');
    });



    // Tickets
    Route::get('/all/ticket', [TicketController::class, 'allTicket'])->name('all.ticket');
    Route::get('/close/ticket/{id}', [TicketController::class, 'closeTicket'])->name('close.ticket');
    Route::get('/show/ticket/{id}', [TicketController::class, 'showTicket'])->name('show.ticket');
    Route::get('/export/ticket', [TicketController::class, 'exportTicket'])->name('export.ticket');



    // Manage Profile
    Route::controller(AdminController::class)->group(function () {

        Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
        Route::post('/adminProfileStore', 'adminProfileStore')->name('adminProfileStore'); # ajax

        Route::get('/admin/change/setting', 'adminChangeSetting')->name('admin.change.setting');
        Route::post('/adminPasswordStore', 'adminPasswordStore')->name('adminPasswordStore'); # ajax

        Route::get('/admin/logout', 'adminDestroy')->name('admin.logout');
    });







    // Manage Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'allProduct')->name('all.product');
        Route::get('/add/product', 'addProduct')->name('add.product');
        Route::post('/store/product', 'storeProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/update/product/', 'updateProduct')->name('update.product');

        Route::post('/update/product/thumbnail', 'updateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/product/multiimage', 'updateProductMultiImage')->name('update.product.multiimage');
        Route::get('/product/multiimage/delete/{id}', 'multiImageDelete')->name('product.multiimage.delete');



        Route::get('/product/inactive/{id}', 'productInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'productActive')->name('product.active');
        Route::get('/delete/product/{id}', 'productDelete')->name('delete.product');

        // stock
        Route::get('/product/stock', 'productStock')->name('product.stock');
    });



    // Manage vendor
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'inactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'activeVendor')->name('active.vendor');
        Route::get('/active/vendor', 'activeVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'activeVendorApprove')->name('active.vendor.approve');

        Route::get('/active/vendor/details/{id}', 'activeVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'inactiveVendorApprove')->name('inactive.vendor.approve');

        //Gestion des administrateurs selon leur role
        Route::get('/all/admin', 'allAdmin')->name('all.admin');
        Route::get('/add/admin', 'addAdmin')->name('add.admin');
        Route::post('/store/admin', 'storeAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'editAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'updateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'deleteAdmin')->name('delete.admin');
    });

    // Manage brand
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'allBrand')->name('all.brand');
        Route::get('/add/brand', 'addBrand')->name('add.brand');
        Route::post('/store/brand', 'storeBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'editBrand')->name('edit.brand');
        Route::post('/update/brand', 'updateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'deleteBrand')->name('delete.brand');
    });

    // Manage category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });





    // Manage slider
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'allSlider')->name('all.slider');
        Route::get('/add/slider', 'addSlider')->name('add.slider');
        Route::post('/store/slider', 'storeSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'editSlider')->name('edit.slider');
        Route::post('/update/slider', 'updateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'deleteSlider')->name('delete.slider');
    });



    // Manage Order
    Route::controller(OrderController::class)->group(function () {
        Route::get('/all/orders', 'allOrder')->name('all.orders');
        Route::get('/order/details/{id}', 'orderDetails')->name('order.details');

        Route::get('/pending-to-confirm/{id}', 'pendingToConfirm')->name('pending-to-confirm');
        Route::get('/confirm-to-processing/{id}', 'confirmToProcessing')->name('confirm-to-processing');
        Route::get('/processing-to-delivered/{id}', 'processingToDelivered')->name('processing-to-delivered');

        Route::get('/invoice-download/{id}', 'orderInvoiceDownload')->name('invoice.download');

        Route::get('/delete/order/{id}', 'deleteOrder')->name('delete.order');
    });

    // Manage User
    Route::controller(ActiveUserController::class)->group(function () {
        Route::get('/all/user', 'allUser')->name('all.user');
        Route::get('/all/vendor', 'allVendor')->name('all.vendor');

        Route::get('/delete/user/{id}', 'deleteUser')->name('delete.user');
        Route::get('/delete/vendor/{id}', 'deleteVendor')->name('delete.vendor');
    });

    // Manage Blog
    Route::controller(BlogController::class)->group(function () {

        // CRUD post
        Route::get('/blog/post', 'allBlogPost')->name('blog.post');
        Route::get('/add/blog/post', 'addBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post', 'storeBlogPost')->name('store.blog.post');

        Route::get('/edit/blog/post/{id}', 'editBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post', 'updateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}', 'deleteBlogPost')->name('delete.blog.post');
    });

    // Manage Review
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/pending/review', 'pendingReview')->name('pending.review');
        Route::get('/approve/review/{id}', 'approveReview')->name('approve.review');

        Route::get('/show/review/{id}', 'showReview')->name('show.review');

        Route::get('/publish/review', 'publishReview')->name('publish.review');
        Route::get('/delete/review/{id}', 'deleteReview')->name('delete.review');
    });

    // Manage Site Setting
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site/setting', 'siteSetting')->name('site.setting');
        Route::post('/store/setting', 'storeSetting')->name('store.setting');

        Route::get('/site/seo', 'seo')->name('site.seo');
        Route::post('/store/seo', 'storeSeo')->name('store.seo');
    });


    // Manage contact message
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact/message', 'contactMessage')->name('contact.message');
        Route::get('/show/message/{id}', 'showMessage')->name('show.message');
        Route::get('/delete/message/{id}', 'deleteMessage')->name('delete.message');
        Route::get('/export/message', 'exportMessage')->name('export.message');
    });

    // Manage Newsletter
    Route::controller(NewsletterController::class)->group(function () {
        Route::get('/newsletter', 'newsletter')->name('newsletter');
        Route::get('/delete/newsletter/{id}', 'deleteNewsletter')->name('delete.newsletter');
        Route::get('/export/newsletter', 'exportNewsletter')->name('export.newsletter');
    });

    // Reports
    Route::controller(ReportController::class)->group(function () {
        Route::get('/all/report', 'allReport')->name('all.report');
        Route::get('/show/report/{id}', 'showReport')->name('show.report');
        Route::get('/delete/report/{id}', 'deleteReport')->name('delete.report');

        Route::get('/all/report/product', 'allReportProduct')->name('all.report.product');
        Route::get('/delete/report/product/{id}', 'deleteReportProduct')->name('delete.report.product');
    });
});













/*
|--------------------------------------------------------------------------
| Vendor all routes
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'role:vendor'])->group(function () {

    // Tickets
    Route::get('/vendor/all/ticket', [VendorTicketController::class, 'vendorAllTicket'])->name('vendor.all.ticket');

    Route::get('/vendor/new/ticket', [VendorTicketController::class, 'vendorNewTicket'])->name('vendor.new.ticket');

    Route::get('/vendor/show/ticket/{id}', [VendorTicketController::class, 'vendorShowTicket'])->name('vendor.show.ticket');

    Route::post('/vendor/store/ticket', [VendorTicketController::class, 'vendorStoreTicket'])->name('vendor.store.ticket');

    Route::get('/vendor/export/ticket', [VendorTicketController::class, 'exportTicket'])->name('vendor.export.ticket');



    // Manage profile
    Route::controller(VendorController::class)->group(function () {

        Route::get('/vendor/dashboard', 'vendorDashboard')->name('vendor.dashboard');
        Route::get('/vendor/profile', 'vendorProfile')->name('vendor.profile');
        Route::post('/vendorProfileStore', 'vendorProfileStore')->name('vendorProfileStore'); # ajax

        Route::get('/vendor/change/setting', 'vendorChangeSetting')->name('vendor.change.setting');
        Route::post('/vendorPasswordStore', 'vendorPasswordStore')->name('vendorPasswordStore'); # ajax

        Route::get('/vendor/logout', 'vendorDestroy')->name('vendor.logout');
    });



    // Manage product
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'vendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'vendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product', 'vendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'vendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product/', 'vendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thumbnail', 'vendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');
        Route::post('/vendor/update/product/multiimage', 'vendorUpdateProductMultiImage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/product/multiimage/delete/{id}', 'vendorMultiImageDelete')->name('vendor.product.multiimage.delete');
        Route::get('/vendor/product/inactive/{id}', 'vendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'vendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'vendorProductDelete')->name('vendor.delete.product');
    });

    // Manage Order
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/order', 'vendorOrder')->name('vendor.order');
        Route::get('/vendor/order/details/{id}', 'vendorOrderDetails')->name('vendor.order.details');
        Route::get('/vendor/invoice/download/{id}', 'vendorInvoiceDownload')->name('vendor.invoice.download');
    });

    // Manage Review
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/vendor/all/review', 'vendorallReview')->name('vendor.all.review');
        Route::get('/vendor/show/review/{id}', 'vendorShowReview')->name('vendor.show.review');
    });
});









/*
|--------------------------------------------------------------------------
| User all routes
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'role:user'])->group(function () {

    // update profile info
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
        Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile'); # ajax
        Route::post('/newPassword', [UserController::class, 'newPassword'])->name('newPassword'); # ajax
        Route::get('/user/logout', [UserController::class, 'userDestroy'])->name('user.logout');
    });


    // acces dashboard pages
    Route::controller(AllUserController::class)->group(function () {
        Route::get('/user/account/page', 'userAccount')->name('user.account.page');
        Route::get('/user/change/password', 'userChangePassword')->name('user.change.password');
        Route::get('/user/order/page', 'userOrderPage')->name('user.order.page');

        Route::get('/user/order-details/{order_id}', 'userOrderDetails');
        Route::get('/user/invoice-download/{order_id}', 'userOrderInvoice');

        // order tracking
        Route::get('/user/track/order', 'userTrackOrder')->name('user.track.order');
        Route::post('/order/tracking', 'orderTracking')->name('order.tracking');
    });
});












Route::middleware(['auth'])->group(function () {

    // Wishlist
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'allWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'getWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'wishlistRemove');
    });

    // My cart
    Route::controller(CartController::class)->group(function () {
        Route::get('/mycart', 'myCart')->name('mycart');
        Route::get('/get-cart-product', 'getCartProduct');
        Route::get('/cart-remove/{rowId}', 'cartRemove');
        Route::get('/cart-decrement/{rowId}', 'cartDecrement');
        Route::get('/cart-increment/{rowId}', 'cartIncrement');
    });



    // Stripe and COD
    Route::controller(StripeController::class)->group(function () {


        Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
        Route::get('/success', [StripeController::class, 'success'])->name('checkout.success');
        Route::get('/failure', [StripeController::class, 'failure'])->name('checkout.failure');




        Route::post('/stripe/order', 'stripeOrder')->name('stripe.order');
        Route::post('/cash/order', 'cashOrder')->name('cash.order');
    });

    // Reports (comment & product)
    Route::controller(ReportController::class)->group(function () {
        Route::post('/storeReport', 'storeReport')->name('storeReport'); # with ajax
        Route::post('/store/report/product', 'storeReportProduct')->name('store.report.product');
    });



    // review
    Route::controller(ReviewController::class)->group(function () {
        Route::post('/storeReview', 'storeReview')->name('storeReview'); # with ajax
    });
});



Route::post('/webhook', [StripeController::class, 'webhook'])->name('checkout.webhook');













// *************************                         *********************************



/*
|--------------------------------------------------------------------------
| Outside middleware all route
|--------------------------------------------------------------------------
*/
Route::controller(IndexController::class)->group(function () {
    Route::get('/product/details/{id}/{slug}', 'productDetails');
    Route::get('/vendor/details/{id}', 'vendorDetails')->name('vendor.details');
    Route::get('/vendor/all', 'vendorAll')->name('vendor.all');
    Route::get('/product/category/{id}/{slug}', 'catWiseProduct');

    Route::get('/brand/details/{id}', 'brandDetails')->name('brand.details');
    Route::get('/brand/all', 'brandAll')->name('brand.all');

    // Route::get('/deals/all', 'deals')->name('deals.all'); // offre spéciale

    // search
    Route::post('/search', 'search')->name('product.search');
    Route::post('/search-product', 'searchProduct');
});


Route::controller(CartController::class)->group(function () {
    Route::post('/cart/data/store/{id}', 'addToCart');
    Route::post('/dcart/data/store/{id}', 'addToCartDetails');
    Route::get('/product/mini/cart', 'addMiniCart');
    Route::get('/minicart/product/remove/{rowId}', 'removeMiniCart');
    Route::post('/coupon-apply', 'couponApply');
    Route::get('/coupon-calculation', 'couponCalculation');
    Route::get('/coupon-remove', 'couponRemove');
    Route::get('/checkout', 'checkoutCreate')->name('checkout');
});

Route::controller(WishlistController::class)->group(function () {
    Route::post('/add-to-wishlist/{product_id}', 'addToWishList');
});


Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'allBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}', 'blogDetails');
});


Route::controller(NotificationController::class)->group(function () {
    Route::get('/notification/mark-as-read/{id}', 'markAsRead')->name('markasread');

    Route::get('/markasread-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    });
});

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'contact')->name('contact');

    Route::post('/contactStore', 'contactStore')->name('contactStore');
});

// Newsletter
Route::controller(NewsletterController::class)->group(function () {
    Route::post('/newsletter/store', 'newsletterStore')->name('newsletter.store');
});


require __DIR__ . '/auth.php';
