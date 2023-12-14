<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['language'], 'namespace' => 'Api'], function () {
    Route::post('get-subscriber-details', "AuthController@getSubscriberDetails")->name('getSubscriberDetails');
    Route::get('districts', "AuthController@districts")->name('districts');
    Route::get('upozilas', "AuthController@upozilas")->name('upozilas');
    Route::get('blood-groups', "AuthController@bloodGroups")->name('bloodGroups');
    Route::get('genders', "AuthController@genders")->name('genders');
    Route::post('sign-up', "AuthController@signUp")->name('api.SignUp');
    Route::post('sign-in', "AuthController@signIn")->name('api.signIn');
    Route::post('send-forget-password-email', "AuthController@sendForgetPasswordEmail")->name('api.sendForgetPasswordEmail');
    Route::post('reset-password', "AuthController@resetPassword")->name('api.resetPassword');

    Route::post('social-login', "AuthController@socialLogin")->name('api.socialLogin');

    Route::group(['middleware' => ['auth:api', 'app.user']], function () {
        Route::get('get-user-details', "AuthController@getUserDetails")->name('getUserDetails');

//        Route::get('resend-email-verification-code', 'AuthController@resendEmailVerificationCode')->name('api.resendEmailVerificationCode');
//        Route::post('email-verification', 'AuthController@emailVerify')->name('api.emailVerification');
//        Route::post('logout', 'AuthController@logout')->name('api.logout');
        Route::group(['middleware' => 'verified.user'], function () {
            Route::post('get-institute', 'DonorController@getInstitute')->name('api.getInstitute');
            Route::post('add-blood-donor', 'DonorController@addBloodDonor')->name('api.addBloodDonor');
            Route::get('get-blood-donor-list', 'DonorController@getDonorList')->name('api.getDonorList');
            Route::get('get-eligible-blood-donor-list', 'DonorController@getEligibleDonorList')->name('api.getEligibleDonorList');
            Route::get('get-volunteers-list', 'ReportController@getVolunteerList')->name('api.getVolunteerList');
            Route::get('get-institute-list/{id}', 'DonorController@getInstituteList')->name('api.getInstituteList');
            Route::post('add-report', 'ReportController@reportAdd')->name('api.reportAdd');
            Route::get('get-reports', 'ReportController@getReports')->name('api.getReports');

            Route::get('send-phone-verification-code', 'UserProfileController@sendPhoneVerificationCode')->name('api.sendPhoneVerificationCode');
            Route::post('phone-verification', 'UserProfileController@phoneVerify')->name('api.phoneVerification');

            Route::get('get-user-profile', 'UserProfileController@getUserProfile')->name('api.getUserProfile');
            Route::post('update-user-profile', 'UserProfileController@updateUserProfile')->name('api.updateUserProfile');
            Route::post('update-password', 'UserProfileController@updatePassword')->name('api.updatePassword');
//
//            Route::get('location-list', 'LocationController@locationList')->name('api.locationList');
//            Route::get('service-list/{location_id}', 'ServiceController@serviceList')->name('api.serviceList');
//            Route::get('availability-list/{location_id}', 'AvailabilityController@availabilityList')->name('api.availabilityList');
            Route::get('news-list', 'NewsController@newsList')->name('api.newsList');

//            Route::get('about-us', 'ContactController@aboutUs')->name('api.aboutUs');
//            Route::get('contact-number', 'ContactController@contactNumber')->name('api.contactNumber');
//            Route::post('contact-us', 'ContactController@contactUs')->name('api.contactUs');
//
//            Route::post('create-appointment', 'AppointmentController@createAppointment')->name('api.createAppointment');
//            Route::get('appointment-list', 'AppointmentController@appointmentList')->name('api.appointmentList');
//            Route::get('appointment-cancel/{appointment_id}', 'AppointmentController@appointmentCancel')->name('api.appointmentCancel');
//
//            Route::get('language-list', 'UserProfileController@languageList')->name('api.languageList');
//            Route::post('set-language', 'UserProfileController@setLanguage')->name('api.setLanguage');
        });

    });
});