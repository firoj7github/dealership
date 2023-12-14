<?php
 
/**
* Created by PhpStorm.
* User: debu
* Date: 7/5/19
* Time: 2:09 PM
*/


/*
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
   Route::group(['middleware' => 'customer'], function () {
       Route::get('dashboard', 'DashboardController@dashboard')->name('admin.dashboard');

       Route::get('calendar-list', 'DoctorController@index')->name('admin.calendarList');
       Route::get('calendar-save', 'DoctorController@calendarAdd')->name('admin.calendarAdd');
       Route::post('calendar-save-process', 'DoctorController@calendarAddProcess')->name('admin.calendarAddProcess');
       Route::get('calendar-edit/{id}', 'DoctorController@calendarEdit')->name('admin.calendarEdit');
       Route::get('calendar-delete/{id}', 'DoctorController@calendarDelete')->name('admin.calendarDelete');

       Route::get('calendar-task-view', 'DoctorTaskController@doctorTaskCalendarView')->name('admin.calendarView');

       Route::post('time-schedule-save-process', 'TimeScheduleController@timeScheduleAddProcess')->name('admin.timeScheduleAddProcess');
       Route::get('time-schedule-edit/{id}', 'TimeScheduleController@timeScheduleEdit')->name('admin.timeScheduleEdit');

       Route::get('service-list', 'ServiceController@index')->name('admin.serviceList');
       Route::get('get-service-name-list', 'ServiceController@getServiceNameList')->name('admin.getServiceNameList');
       Route::get('service-save', 'ServiceController@serviceAdd')->name('admin.serviceAdd');
       Route::post('service-save-process', 'ServiceController@serviceAddProcess')->name('admin.serviceAddProcess');
       Route::get('service-edit/{id}', 'ServiceController@serviceEdit')->name('admin.serviceEdit');
       Route::get('service-delete/{id}', 'ServiceController@serviceDelete')->name('admin.serviceDelete');

       Route::get('location-list', 'ClinicController@index')->name('admin.locationList');
       Route::get('location-save', 'ClinicController@locationAdd')->name('admin.locationAdd');
       Route::post('location-save-process', 'ClinicController@locationAddProcess')->name('admin.locationAddProcess');
       Route::get('location-edit/{id}', 'ClinicController@locationEdit')->name('admin.locationEdit');
       Route::get('location-delete/{id}', 'ClinicController@locationDelete')->name('admin.locationDelete');

       Route::get('appointment-list/{type}', 'AppointmentController@index')->name('admin.appointmentList');
       Route::get('appointment-save', 'AppointmentController@appointmentAdd')->name('admin.appointmentAdd');
       Route::post('appointment-save-process', 'AppointmentController@appointmentAddProcess')->name('admin.appointmentAddProcess');
       Route::get('appointment-edit/{id}', 'AppointmentController@appointmentEdit')->name('admin.appointmentEdit');
       Route::get('appointment-delete/{id}', 'AppointmentController@appointmentDelete')->name('admin.appointmentDelete');
       Route::post('update-appointment', 'AppointmentController@updateAppointment')->name('admin.updateAppointment');
       Route::get('add-new-appointment', 'AppointmentController@addNewAppointment')->name('admin.addNewAppointment');

       Route::get('get-all-data-of-clinic', 'AppointmentController@getAllDataOfAClinic')->name('admin.getAllDataOfAClinic');

       Route::get('news-list', 'NewsController@index')->name('admin.newsList');
       Route::get('news-save', 'NewsController@newsAdd')->name('admin.newsAdd');
       Route::post('news-save-process', 'NewsController@newsAddProcess')->name('admin.newsAddProcess');
       Route::get('news-edit/{id}', 'NewsController@newsEdit')->name('admin.newsEdit');
       Route::get('news-delete/{id}', 'NewsController@newsDelete')->name('admin.newsDelete');

       Route::get('settings', 'SettingsController@settings')->name('admin.settings');
       Route::post('settings-save-process', 'SettingsController@settingsSaveProcess')->name('admin.settingsSaveProcess');

       Route::get('push-notification', 'NotificationController@pushNotification')->name('admin.pushNotification');
       Route::post('send-push-notification', 'NotificationController@sendPushNotification')->name('admin.sendPushNotification');
       Route::get('sms-notification', 'NotificationController@smsNotification')->name('admin.smsNotification');
       Route::post('send-sms-notification', 'NotificationController@sendSmsNotification')->name('admin.sendSmsNotification');
       Route::get('email-notification', 'NotificationController@emailNotification')->name('admin.emailNotification');
       Route::post('send-email-notification', 'NotificationController@sendEmailNotification')->name('admin.sendEmailNotification');
       Route::post('test-email-notification', 'NotificationController@testEmailNotification')->name('admin.testEmailNotification');
       Route::get('campaign-history', 'NotificationController@campaignHistory')->name('admin.campaignHistory');

       Route::get('user-list', 'UserController@index')->name('admin.userList');
       Route::get('user-save', 'UserController@userAdd')->name('admin.userAdd');
       Route::post('user-save-process', 'UserController@userAddProcess')->name('admin.userAddProcess');
       Route::get('user-edit/{id}', 'UserController@userEdit')->name('admin.userEdit');
       Route::get('user-view/{id}', 'UserController@userView')->name('admin.userView');
       Route::get('user-appointment-list', 'UserController@userAppointmentList')->name('admin.userAppointmentList');
       Route::get('user-delete/{id}', 'UserController@userDelete')->name('admin.userDelete');
       Route::get('get-user-list', 'UserController@getUserList')->name('admin.getUserList');

       Route::get('support-message-list', 'SupportController@supportMessageList')->name('admin.supportMessageList');
       Route::get('support-message-read/{id}', 'SupportController@supportMessageRead')->name('admin.supportMessageRead');
       Route::get('support-message-delete/{id}', 'SupportController@supportMessageDelete')->name('admin.supportMessageDelete');
   });*/
 ///**
// * Created by PhpStorm.
// * User: debu
// * Date: 7/5/19
// * Time: 2:09 PM
// */
//
//
//
Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'customer'], function () {
        Route::get('dashboard', 'DashboardController@dashboard')->name('admin.dashboard');

        Route::get('donor-list', 'DonorController@index')->name('admin.donorList');
        Route::get('donor-save', 'DonorController@donorAdd')->name('admin.donorAdd');
        Route::post('donor-save-process', 'DonorController@donorAddProcess')->name('admin.donorAddProcess');
        Route::get('donor-edit/{id}', 'DonorController@donorEdit')->name('admin.donorEdit');
        Route::get('donor-delete/{id}', 'DonorController@donorDelete')->name('admin.donorDelete');

        Route::get('institute-list', 'InstituteController@index')->name('admin.instituteList');
        Route::get('institute-save', 'InstituteController@instituteAdd')->name('admin.instituteAdd');
        Route::post('institute-save-process', 'InstituteController@instituteAddProcess')->name('admin.instituteAddProcess');
        Route::get('institute-edit/{id}', 'InstituteController@instituteEdit')->name('admin.instituteEdit');
        Route::get('institute-delete/{id}', 'InstituteController@instituteDelete')->name('admin.instituteDelete');
        Route::post('add-institute-from-excel', 'InstituteController@addInstituteFromExcel')->name('admin.addInstituteFromExcel');
        Route::get('get-institutes', 'InstituteController@getInstitutes')->name('admin.getInstitutes');
    });
});
