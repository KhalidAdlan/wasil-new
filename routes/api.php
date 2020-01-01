<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Customers
    Route::apiResource('customers', 'CustomerApiController');

    // Drivers
    Route::post('drivers/media', 'DriverApiController@storeMedia')->name('drivers.storeMedia');
    Route::apiResource('drivers', 'DriverApiController');

    // Lines
    Route::apiResource('lines', 'LineApiController');

    // Orders
    Route::apiResource('orders', 'OrderApiController');

    // Salesmen
    Route::post('salesmen/media', 'SalesmenApiController@storeMedia')->name('salesmen.storeMedia');
    Route::apiResource('salesmen', 'SalesmenApiController');
});
