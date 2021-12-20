<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

$namespace = "App\Http\Controllers\Home";
$namespaceLogin = "App\Http\Controllers\Login";
$namespaceAdmin = "App\Http\Controllers\Admin";
//Không cần đăng nhập

Route::group(
    ['namespace' => $namespace, 'prefix' => '', 'middleware' => ['web']],
    function () {
        Route::get('', 'IndexController@Index')->name('Home');
        Route::get('product', 'ProductController@Index')->name('Product');
        Route::get('product-details/{id}', 'ProductDetailsController@Index')->name('ProductDetails');
        Route::get('contact', 'ContactController@Index')->name('Contact');
        Route::get('cart', 'CartController@Index')->name('Cart');
        Route::get('search-product', 'SearchController@SearchProduct')->name('SearchProduct');
        Route::get('filter', 'ProductController@Filter')->name('Filter');
        Route::get('search-category', 'CategoryController@SearchCategory')->name('SearchCategory');
        Route::get('filter-category', 'CategoryController@FilterCategory')->name('FilterCategory');
        Route::post('post-contact', 'ContactController@postContact')->name('postContact');
        Route::get('/add-cart/{id}', 'CartController@AddCart')->name('AddCart');
        Route::post('/update-cart/{id}', 'CartController@UpdateCart')->name('UpdateCart');
        Route::get('/remove-cart/{id}', 'CartController@RemoveCart')->name('RemoveCart');
    }
);

//cần đăng nhập

Route::group(
    ['namespace' => $namespace, 'prefix' => '', 'middleware' => ['web','auth', 'CheckLogin']],
    function () {
        Route::get('/history-order', 'HistoryOrderController@Index')->name('HistoryOrder');
        Route::post('/order', 'CartController@Order')->name('Order');
        Route::get('/destroy-order', 'HistoryOrderController@DestroyOrder')->name('DestroyOrder');
    }
);

//Đăng nhập với tư cách admin
Route::group(
    ['namespace' => $namespaceAdmin, 'prefix' => 'admin/', 'middleware' => ['web', 'auth', 'CheckAdminLogin']],
    function () {
        Route::get('', 'IndexController@Index')->name('HomeAdmin');

        Route::get('category', 'CategoryController@Index')->name('CateAdmin');
        Route::get('view-add-category', 'CategoryController@ViewAddCate')->name('ViewAddCate');
        Route::get('view-edit-category', 'CategoryController@ViewEditCate')->name('ViewEditCate');
        Route::post('add-category', 'CategoryController@AddCate')->name('AddCate');
        Route::post('edit-category', 'CategoryController@UpdateCate')->name('UpdateCate');
        Route::get('delete-category', 'CategoryController@Delete')->name('Delete');
        Route::get('deletes-category', 'CategoryController@Deletes')->name('Deletes');

        Route::get('product', 'ProductController@Index')->name('ProductAdmin');
        Route::get('view-add-product', 'ProductController@ViewAddProduct')->name('ViewAddProduct');
        Route::get('view-edit-product', 'ProductController@ViewEditProduct')->name('ViewEditProduct');
        Route::post('add-product', 'ProductController@AddProduct')->name('AddProduct');
        Route::post('edit-product', 'ProductController@UpdateProduct')->name('UpdateProduct');
        Route::get('delete-product', 'ProductController@Delete')->name('Delete');
        Route::get('deletes-product', 'ProductController@Deletes')->name('Deletes');

        Route::get('slider', 'SliderController@Index')->name('SliderAdmin');
        Route::get('view-add-slider', 'SliderController@ViewAddSlider')->name('ViewAddSlider');
        Route::get('view-edit-slider', 'SliderController@ViewEditSlider')->name('ViewEditSlider');
        Route::post('add-slider', 'SliderController@AddSlider')->name('AddSlider');
        Route::post('edit-slider', 'SliderController@UpdateSlider')->name('UpdateSlider');
        Route::get('delete-slider', 'SliderController@Delete')->name('Delete');
        Route::get('deletes-slider', 'SliderController@Deletes')->name('Deletes');

        Route::get('partners', 'PartnersController@Index')->name('PartnersAdmin');
        Route::get('view-add-partners', 'PartnersController@ViewAddPartners')->name('ViewAddPartners');
        Route::get('view-edit-partners', 'PartnersController@ViewEditPartners')->name('ViewEditPartners');
        Route::post('add-partners', 'PartnersController@AddPartners')->name('AddPartners');
        Route::post('edit-partners', 'PartnersController@UpdatePartners')->name('UpdatePartners');
        Route::get('delete-partners', 'PartnersController@Delete')->name('Delete');
        Route::get('deletes-partners', 'PartnersController@Deletes')->name('Deletes');

        Route::get('info', 'InfoController@Index')->name('InfoAdmin');
        Route::get('view-add-info', 'InfoController@ViewAddInfo')->name('ViewAddInfo');
        Route::get('view-edit-info', 'InfoController@ViewEditInfo')->name('ViewEditInfo');
        Route::post('add-info', 'InfoController@AddInfo')->name('AddInfo');
        Route::post('edit-info', 'InfoController@UpdateInfo')->name('UpdateInfo');
        Route::get('delete-info', 'InfoController@Delete')->name('Delete');
        Route::get('deletes-info', 'InfoController@Deletes')->name('Deletes');

        Route::get('contact', 'ContactController@Index')->name('ContactAdmin');
        Route::get('read-contact', 'ContactController@ReadContact')->name('ReadContact');

        Route::get('user', 'UserController@Index')->name('AccountUser');
        Route::get('insert-role', 'UserController@EditRole')->name('EditRole');
        Route::get('account-admin', 'UserController@AccountAdmin')->name('AccountAdmin');
        Route::get('delete-role', 'UserController@DeleteRole')->name('DeleteRole');

        Route::get('order-destroy', 'OrderController@ViewOrderDestroy')->name('ViewOrderDestroy');
        Route::get('order-confirm', 'OrderController@ViewOrderConfirm')->name('ViewOrderConfirm');
        Route::get('order-delivery', 'OrderController@ViewOrderDelivery')->name('ViewOrderDelivery');
        Route::get('order-success', 'OrderController@ViewOrderOk')->name('ViewOrderOk');
        Route::get('get-order-confirm/{id}', 'OrderController@getOrderConfirm')->name('getOrderConfirm');
        Route::get('get-order-delivery/{id}', 'OrderController@getOrderDelivery')->name('getOrderDelivery');
        Route::get('get-order-success/{id}', 'OrderController@getOrderOk')->name('getOrderOk');
        Route::get('delete-order', 'OrderController@DeleteOrder')->name('DeleteOrder');
        Route::get('update-order', 'OrderController@ConfirmOrder')->name('ConfirmOrder');
        Route::get('delivery-order', 'OrderController@DeliveryOrder')->name('DeliveryOrder');

    }
);

Route::group(
    ['namespace' => $namespaceLogin, 'prefix' => '', 'middleware' => ['web']],
    function () {
        Route::get('/login', 'LoginController@Index')->name('Login');
        Route::post('/post-login', 'LoginController@Login')->name('PostLogin');
        Route::get('/register', 'RegisterController@Index')->name('Register');
        Route::post('/post-register', 'RegisterController@Register')->name('PostRegister');
        Route::get('/logout', 'LoginController@Logout')->name('Logout');
     
    }
);
