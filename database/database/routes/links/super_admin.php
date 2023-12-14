<?php
/**
 * Created by PhpStorm.
 * User: debu
 * Date: 7/5/19
 * Time: 2:08 PM
 */


Route::group(['middleware' => 'auth', 'namespace' => 'SuperAdmin', 'prefix' => 'super-admin'], function () {
    Route::group(['middleware' => 'super.admin'], function () {
        Route::get('dashboard', 'DashboardController@dashboard')->name('superAdmin.dashboard');

//        Route::get('subscription-package-list', 'SubscriptionPackageController@index')->name('superAdmin.subscriptionPackageList');
//        Route::get('subscription-package-save', 'SubscriptionPackageController@subscriptionPackageAdd')->name('superAdmin.subscriptionPackageAdd');
//        Route::post('subscription-package-save-process', 'SubscriptionPackageController@subscriptionPackageAddProcess')->name('superAdmin.subscriptionPackageAddProcess');
//        Route::get('subscription-package-edit/{id}', 'SubscriptionPackageController@subscriptionPackageEdit')->name('superAdmin.subscriptionPackageEdit');
//        Route::get('subscription-package-delete/{id}', 'SubscriptionPackageController@subscriptionPackageDelete')->name('superAdmin.subscriptionPackageDelete');

        Route::get('customer-list', 'CustomerController@index')->name('superAdmin.customerList');
        Route::get('customer-save', 'CustomerController@customerAdd')->name('superAdmin.customerAdd');
        Route::post('customer-save-process', 'CustomerController@customerAddProcess')->name('superAdmin.customerAddProcess');
        Route::get('customer-edit/{id}', 'CustomerController@customerEdit')->name('superAdmin.customerEdit');
        Route::get('customer-delete/{id}', 'CustomerController@customerDelete')->name('superAdmin.customerDelete');

        Route::get('settings', 'SettingsController@settings')->name('superAdmin.settings');
        Route::post('settings-save-process', 'SettingsController@settingsSaveProcess')->name('superAdmin.settingsSaveProcess');
    });
});
