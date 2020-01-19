<?php

Route::get('/', 'HomeController@index');
Route::post('/cart/{id}', 'HomeController@addToCart')->name('cart.add');
Route::get('/product/{id}', 'HomeController@showProduct')->name('product.show');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/category/{id}', 'HomeController@category')->name('category');


Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});


Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tags
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::resource('products', 'ProductController');

    // Customers
    Route::delete('customers/destroy', 'CustomerController@massDestroy')->name('customers.massDestroy');
    Route::resource('customers', 'CustomerController');

    // Drivers
    Route::delete('drivers/destroy', 'DriverController@massDestroy')->name('drivers.massDestroy');
    Route::post('drivers/media', 'DriverController@storeMedia')->name('drivers.storeMedia');
    Route::resource('drivers', 'DriverController');

    // Lines
    Route::delete('lines/destroy', 'LineController@massDestroy')->name('lines.massDestroy');
    Route::resource('lines', 'LineController');

    // Orders
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Salesmen
    Route::delete('salesmen/destroy', 'SalesmenController@massDestroy')->name('salesmen.massDestroy');
    Route::post('salesmen/media', 'SalesmenController@storeMedia')->name('salesmen.storeMedia');
    Route::resource('salesmen', 'SalesmenController');
});
