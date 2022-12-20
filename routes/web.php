<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\WarehouseController;

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


// ADMIN


    // Dang Nhap Vao He Thong

        Route::get('admin/loginad',function(){
            return view('admin.loginad');
        });
        Route::post("/admin/loginad",[AdminController::class,"loginPost"])->name('admin.loginPost');
    
    // QUAN LI ADMIN  
        Route::middleware(['admin'])->group(function () {
            Route::get("/admin/homepage",[AdminController::class,"homepage"])->name('admin.homepage');

            // Nhân Sự
            Route::get("/admin/profile",[AdminController::class,"profile"])->name('admin.profile');
            Route::post("/admin/changepass",[AdminController::class,"changePass"])->name('admin.changepass');

            // Loại Hình
            Route::get("/admin/display",[ArticleController::class,"display"])->name('article.display');

            // Bài Viết
            Route::get("/admin/article-manage",[ArticleController::class,"Manage"])->name('article.article-manage');

            // Danh Mục
            Route::get("/admin/show",[CategoryController::class,"display"])->name('category.show');
            
            // Loại Sản Phẩm
            Route::get("/admin/product/distype",[ProductController::class,"display"])->name('product.distype');

            // Thương Hiệu
            Route::get("/admin/product/brand",[ProductController::class,"brand"])->name('product.brand');
            
            // Sản Phẩm
            Route::get("/admin/product/promanage",[ProductController::class,"show"])->name('product.promanage');

            // Thư Viện Ảnh
            Route::get("/admin/product/gallery/{id}",[GalleryController::class,"addGallery"])->name('product.gallery');
            Route::post("/admin/product/load-gallery",[GalleryController::class,"loadGallery"]);
            Route::post("/admin/product/insert-gallery/{id}",[GalleryController::class,"insertGallery"]);
            Route::post("/admin/product/update-gallery",[GalleryController::class,"updateGallery"]);
            Route::post("/admin/product/delete-gallery",[GalleryController::class,"deleteGallery"]);

            // Đơn Hàng
            Route::get("/admin/order-manage",[OrderController::class,"orderManage"])->name('order.index');
            Route::get("/admin/order-detail/{order_code}",[OrderController::class,"orderDetail"])->name('order.detail');
            Route::get("/admin/order-status/{id}",[OrderController::class,"orderStatus"])->name('order.status');
            Route::post("/admin/order/update-stock",[OrderController::class,"updateStock"])->name('order.stock');


            //Liên Hệ
            Route::get("/admin/contact",[ContactController::class,"contact"])->name('cont.contact');
            Route::get("/admin/cont-status/{id}",[ContactController::class,"contStatus"])->name('cont.contstatus');
            Route::get("/admin/cont-del/{id}",[ContactController::class,"contDel"])->name('cont.contdel');

            // Tài Khoản
            Route::get("/manage-customer",[OrderController::class,"manageCustomer"])->name('customer.manage-customer');
            Route::get("/admin/delcustomer/{id}",[OrderController::class,"delete"])->name('customer.del');

            // Phí Vận Chuyển
            Route::get("/admin/feeship-manage",[DeliveryController::class,"feeManage"])->name('feeship.feemanage');
            Route::get("/admin/feeship-index",[DeliveryController::class,"index"])->name('feeship.index');
            Route::post("/admin/feeship/parent",[DeliveryController::class,"parentDelivery"]);
            Route::post("/admin/feeship/addfee",[DeliveryController::class,"addFee"]);
            Route::post("/admin/feeship/display",[DeliveryController::class,"display"]);
            Route::post("/admin/feeship/editfee",[DeliveryController::class,"editFee"]);
            Route::post("/admin/feeship/deletefee",[DeliveryController::class,"deleteFee"]);
            Route::get("/admin/feeship-del/{id}",[DeliveryController::class,"delFee"]);

            // Nhập Hàng
            Route::get("/warehouse",[WarehouseController::class,"index"])->name('warehouse.add-receipt');
            Route::get("/warehouse/manage-receipt",[WarehouseController::class,"manage"])->name('warehouse.manage-receipt');
            Route::get("/warehouse/detail/{wr_code}",[WarehouseController::class,"detail"])->name('warehouse.detail');
            Route::post("/admin/warehouse/create",[WarehouseController::class,"createReceipt"])->name('warehouse.create');
            Route::post("/admin/warehouse/update",[WarehouseController::class,"update"])->name('warehouse.update');

            // Trò Chuyện
              Route::get("/chatbot",[BotManController::class,"index"])->name('chatbot.add-key');
              Route::get("/chatbot/manage-key",[BotManController::class,"manage"])->name('chatbot.manage-key');
              Route::post("/chatbot/edit-keyword",[BotManController::class,"editModel"])->name('chatbot.editkey');
              Route::post("/chatbot/edit-greet",[BotManController::class,"editGreet"])->name('chatbot.editgreet');
              Route::get("/chatbot/editkey-other/{id}",[BotManController::class,"editkeyOther"])->name('chatbot.editkey-other');
              Route::post("/chatbot/editkey-other/{id}",[BotManController::class,"savekeyOther"]);
              Route::get("/chatbot/editkey-model/{id}",[BotManController::class,"editkeyModel"])->name('chatbot.editkey-model');
              Route::post("/chatbot/editkey-model/{id}",[BotManController::class,"savekeyModel"]);
              Route::post("/chatbot/add-key",[BotManController::class,"saveKey"])->name('chatbot.savekey');
              Route::post("/chatbot/save-key",[BotManController::class,"savekeyUser"])->name('chatbot.savekey-user');
              Route::post("/chatbot/update-key/{id}",[BotManController::class,"updateKey"])->name('chatbot.update');
        });
        Route::middleware(['role'])->group(function () {
            

            // Thống Kê
            Route::post("/admin/filter-revenue",[AdminController::class,"filterRevenue"]);
            Route::post("/admin/filter-time",[AdminController::class,"filterTime"]);

            // Nhân Sự
            Route::get("/create-staff",[AdminController::class,"createStaff"])->name('staff.create');
            Route::post("/create-staff",[AdminController::class,"storeStaff"])->name('staff.store');
            Route::get("/manage-staff",[AdminController::class,"manageStaff"])->name('staff.manage-staff');
            Route::get("/admin/role-change/{id}",[AdminController::class,"roleChange"])->name('staff.role-change');
            Route::get("/admin/delstaff/{id}",[AdminController::class,"delete"])->name('staff.del');

            // Loại Hình
            Route::get("/admin/createType",[ArticleController::class,"createType"])->name('article.createtype');
            Route::post("/admin/cType",[ArticleController::class,"cType"])->name('article.ctype');
            Route::get("/admin/gettype/{id}",[ArticleController::class,"getType"])->name('article.gettype');
            Route::post("/admin/posttype/{id}",[ArticleController::class,"postType"])->name('article.posttype');
            Route::get("/admin/deltype/{id}",[ArticleController::class,"delType"])->name('article.deltype');

            // Bài Viết
            Route::get("/admin/writeArticle",[ArticleController::class,"writeArticle"])->name('article.writearticle');
            Route::post("/admin/postArticle",[ArticleController::class,"postArticle"])->name('article.postarticle');
            Route::get("/admin/delete/{id}",[ArticleController::class,"delete"])->name('article.delete');
            Route::get("/admin/edit/{id}",[ArticleController::class,"edit"])->name('article.edit');
            Route::post("/admin/editarticle/{id}",[ArticleController::class,"editAr"])->name('article.editarticle'); 
            Route::post("/admin/import-excel",[ArticleController::class,"importExcel"])->name('article.excel');

            // Danh Mục
            Route::post("/admin/store",[CategoryController::class,"store"])->name('category.store');
            Route::get("/admin/getcate/{id}",[CategoryController::class,"getCate"])->name('category.getcate');
            Route::post("/admin/postcate/{id}",[CategoryController::class,"postCate"])->name('category.postcate');
            Route::get("/admin/delcate/{id}",[CategoryController::class,"delCate"])->name('category.delcate');

            // Loại Sản Phẩm
            Route::get("/admin/product/createType",[ProductController::class,"createType"])->name('product.createtype');
            Route::post("/admin/product/cType",[ProductController::class,"saveType"])->name('product.save');
            Route::get("/admin/product/gettype/{id}",[ProductController::class,"getType"])->name('product.gettype');
            Route::post("/admin/product/posttype/{id}",[ProductController::class,"postType"])->name('product.posttype');
            Route::get("/admin/product/deltype/{id}",[ProductController::class,"delType"])->name('product.deltype');

            // Thương Hiệu
            Route::get("/admin/product/getbrand/{id}",[ProductController::class,"getBrand"])->name('product.getbrand');
            Route::post("/admin/product/postbrand/{id}",[ProductController::class,"postBrand"])->name('product.postbrand');
            Route::get("/admin/product/delbrand/{id}",[ProductController::class,"delBrand"])->name('product.delbrand');

            // Sản Phẩm
            Route::get("/admin/product/add",[ProductController::class,"add"])->name('product.add');
            Route::post("/admin/product/store",[ProductController::class,"store"])->name('product.store');
            Route::get("/admin/product/delete/{id}",[ProductController::class,"delete"])->name('product.delete');
            Route::get("/admin/product/edit/{id}",[ProductController::class,"edit"])->name('product.edit');
            Route::post("/admin/product/editsave/{id}",[ProductController::class,"editSave"])->name('product.editsave');

            // Đơn Hàng
            Route::get("/admin/order-del/{id}",[OrderController::class,"orderDel"])->name('order.del');

            // Nhập Hàng
            Route::get("/admin/warehouse-del/{id}",[WarehouseController::class,"delete"])->name('warehouse.del');
            Route::post("/warehouse/status/{wr_code}",[WarehouseController::class,"status"])->name('warehouse.status');

            // Trò chuyện
            Route::get("/chatbot/delkey/{id}",[WarehouseController::class,"delKey"])->name('chatbot.delkey');

  
        });

        // Đăng Xuất
        Route::get("/admin/logout",[AdminController::class,"logout"])->name('admin.logout');
        Route::get("/admin/test",[AdminController::class,"test"])->name('admin.test');

   

// TRANG MASTER

        Route::get("/",[HomeController::class,"index"])->name('home.index');       
        Route::get("/home/newsread/{id}",[HomeController::class,"newsRead"])->name('home.newsread');
        Route::get("/home/about",[HomeController::class,"aboutUs"])->name('home.about');
        Route::get("/home/{id}/{slug}.html",[HomeController::class,"showAtype"]);
        Route::get("/home/contact",[HomeController::class,"contact"])->name('home.contact');
        Route::post("/postcontact",[HomeController::class,"postContact"])->name('home.postcontact');
        // Route::get("/home/{name}/{id}/{id}/{slug}.html",[HomeController::class,"showAtype"]);
       
        // Route::get("/triathlon/{id}/{id}/{slug}.html",[HomeController::class,"showAtype"]);
      
    
// TRANG SHOP
    Route::group(['prefix'=>'shop'],function(){
        Route::get("homepage",[ShopController::class,"index"])->name('shop.homepage');
        Route::get("display",[ShopController::class,"display"])->name('shop.display');
        Route::get("shopping",[ShopController::class,"shopping"])->name('shop.shopping');
        Route::get("category/{id}/{slug}.html",[HomeController::class,"showCate"])->name('home.showcate'); 
        Route::get("detail/{id}",[ShopController::class,"detail"])->name('shop.detail');
        Route::get("category/{id}/{slug}.html",[ShopController::class,"category"]); 
        Route::get("search",[ShopController::class,"search"])->name('shop.search');
        Route::get("discount",[ShopController::class,"discount"])->name('shop.discount');
        Route::get("selling",[ShopController::class,"selling"])->name('shop.selling');
        Route::post("comment",[ShopController::class,"comment"])->name('shop.comment');
        Route::post("get-comment",[ShopController::class,"getComment"]);
        Route::post("rating",[ShopController::class,"getRating"])->name('shop.rating');

        // Người dùng
        Route::get("history",[ShopController::class,"history"])->name('shop.history');
        Route::get("history-view/{id}",[ShopController::class,"historyView"])->name('shop.historyview');
        Route::get("profile",[ShopController::class,"profile"])->name('shop.profile');
        Route::post("changepass",[ShopController::class,"changePass"])->name('shop.changepass');
    });

        // Giỏ Hàng
    Route::group(['prefix'=>'cart'],function(){
        Route::get("add/{id}",[CartController::class,"addCart"])->name('shop.addcart');
        Route::get("show",[CartController::class,"showCart"])->name('shop.showcart');
        Route::get("delete/{id}",[CartController::class,"deleteCart"])->name('shop.deletecart');
        Route::post("update",[CartController::class,"updateCart"])->name('shop.updatecart');
        Route::post("add/detail",[CartController::class,"addfromDetail"])->name('shop.addfromdetail');
        Route::get('increment/{id}/{qty}/{pro_id}', [CartController::class,"cartIncrement"])->name('shop.increment');
        Route::get('decrement/{id}/{qty}', [CartController::class,"cartDecrement"])->name('shop.decrement');
    
    });

        // Thanh Toán
    Route::group(['prefix'=>'checkout'],function(){
        Route::post("signin",[CheckOutController::class,"signIn"])->name('shop.signin');
        Route::get("logincheck",[CheckOutController::class,"loginCheck"])->name('shop.logincheck');
        Route::post("signup",[CheckOutController::class,"signUp"])->name('shop.signup');
        Route::get("checkform",[CheckOutController::class,"checkOut"])->name('shop.checkform');
        Route::get("logout",[CheckOutController::class,"logOut"])->name('shop.logout');
        Route::post("cus_info",[CheckOutController::class,"cusInfo"])->name('shop.cus_info');
        Route::get("payment",[CheckOutController::class,"payMent"])->name('shop.payment');
        Route::post("order",[CheckOutController::class,"order"])->name('shop.order');
        Route::post("delivery",[CheckoutController::class,"Delivery"]);           
        Route::post("shipping",[CheckoutController::class,"Shipping"])->name('shop.shipping');

        // Checkout Sevive
        Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
        Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
        Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
        Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

        // Social Login
        Route::get("login-google",[SocialController::class,"logGoogle"])->name('shop.google');
        Route::get("google/callback",[SocialController::class,"callbackGoogle"])->name('shop.callback.google');

    });

    //BOT
        Route::match(['get', 'post'], '/botman', [BotManController::class,"handle"]);