<?php

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

Route::group(['namespace' => 'Frontend'], function ()   {
    Route::post('tracer-study/login', 'FrontController@tracerStudyLoginProses');
    Route::get('tracer-study/logout', 'FrontController@tracerStudyLogout');
    Route::get('tracer-study/login', 'FrontController@tracerStudyLogin');
    
    /** halaman setelah login, alumni */
    Route::group(['middleware' => ['student'], 'prefix' => 'tracer-study'], function () {
        Route::post('kuesioner', 'TracerStudyController@simpanKuesioner');
        Route::get('kuesioner/back', 'TracerStudyController@kuesionerBack');
        Route::get('kuesioner', 'TracerStudyController@formKuesioner');
        Route::post('identitas-diri', 'TracerStudyController@simpanIdentitasDiri');
        Route::get('/', 'TracerStudyController@index');

    });

    Route::get('/', 'FrontController@index');

});

Route::get('download/{folder}/{name}', 'DownloadFileController@download');
Route::group(['middleware' => 'auth'], function ()   {
    Route::get('home', 'HomeController@index');
});

// surveyor
Route::group(['middleware' => ['auth', 'role:surveyor']], function () {
    Route::get('tracking/download/{type}', 'TrackingParticipantController@downloadExcel');
    Route::get('tracking/download', 'TrackingParticipantController@downloadExcel');
    Route::get('tracking', 'TrackingParticipantController@index');
});

// user survey
Route::group(['prefix' => 'survey-stackholder', 'namespace' => 'SurveyStackholder', 'middleware' => ['auth', 'role:user.survey']], function () {
    Route::resource('company-account', 'CompanyAccountController');
    Route::get('company/download/{id}', 'CompanyController@download');
    Route::get('company/{id}', 'CompanyController@detail');
    Route::get('company', 'CompanyController@index');
    Route::post('kuesioner/chart', 'KuesionerController@_chartStore');
    Route::get('kuesioner/{id}/chart', 'KuesionerController@_chart');
    Route::get('kuesioner/{id}', 'KuesionerController@_show');
    Route::get('kuesioner', 'KuesionerController@index');
    // dashboard
    Route::get('download', 'HomeController@download');
    Route::get('filter', 'HomeController@filter');
    Route::post('save-layout', 'HomeController@storeLayout');
    Route::get('/', 'HomeController@index');
});

// administrator
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // user survey
    Route::group(['prefix' => 'user-survey', 'namespace' => 'UserSurvey'], function () {
        Route::resource('company', 'CompanyController');
        Route::get('kuesioner/{id}/copy', 'KuesionerController@copy');
        Route::resource('kuesioner', 'KuesionerController');
        Route::resource('periode', 'PeriodeController');
        Route::resource('company-account', 'CompanyAccountController');
        Route::resource('report', 'ReportController');
    });

    // tracer study
    Route::get('schedule/{id}/detail-department', 'ScheduleController@_detailDepartment');
    Route::get('schedule/{id}/detail-program-study', 'ScheduleController@_detailProgramStudy');
    Route::get('schedule/{id}/report', 'ScheduleController@_report');
    Route::get('schedule/{id}/detail', 'ScheduleController@_detail');
    Route::get('schedule/{id}/{angkatan}/{jurusan}/{program}', 'ScheduleController@downloadExcelReport');
    // master
    Route::resource('schedule', 'ScheduleController', ['except' => [
        'show'
    ]]);
    Route::resource('type-business', 'TypeBusinessController', ['except' => [
        'show'
    ]]);
    Route::resource('alumnus', 'AlumnusController', ['except' => [
        'show'
    ]]);
    Route::resource('job', 'JobController', ['except' => [
        'show'
    ]]);
    Route::post('group/sort', 'GroupController@_storeSort');
    Route::resource('group', 'GroupController', ['except' => [
        'show'
    ]]);
    
    Route::resource('user', 'UserController', ['except' => [
        'show'
    ]]);
    Route::get('participant/{id}/answer', 'ParticipantController@alumniAnswer');
    Route::get('participant', 'ParticipantController@index');
    
    // alumni lawas
    Route::delete('alumni-lawas/{id}', 'AlumniLawasController@delete');
    Route::get('alumni-lawas', 'AlumniLawasController@index');
    
    // periode
    Route::post('period/kuesioner-order', 'PeriodController@SimpanKuesionerOrder');
    Route::get('period/{id}/kuesioner-order', 'PeriodController@kuesionerOrder');
    Route::post('period/set-kuesioner', 'PeriodController@_store');
    Route::get('period/set-kuesioner/{id}', 'PeriodController@_setKuesioner');
    Route::resource('period', 'PeriodController');

    // kuesioner
    Route::get('kuesioner/remove-logic/{id}', 'KuesionerController@_removeLogic');
    Route::get('kuesioner/remove-item/{id}', 'KuesionerController@_removeItem');
    Route::get('kuesioner/remove-item-value/{id}', 'KuesionerController@_removeItemValue');
    Route::post('grup/store', 'GroupController@_store');
    Route::get('kuesioner/detail', 'KuesionerController@_detail');
    Route::post('kuesioner', 'KuesionerController@store');
    Route::resource('kuesioner/A', 'KuesionerTypeAController');
    Route::resource('kuesioner/B', 'KuesionerTypeBController');
    Route::resource('kuesioner/C', 'KuesionerTypeCController');
    Route::resource('kuesioner/D', 'KuesionerTypeDController');
    Route::resource('kuesioner/E', 'KuesionerTypeEController');
    
    Route::post('kuesioner/sort', 'KuesionerController@_storeSort');
    Route::get('kuesioner/group/{id}', 'KuesionerController@showByGroup');
    Route::post('kuesioner/setting', 'KuesionerController@_storeSetting');
    Route::get('kuesioner/get-answer/{kuesioner_id}', 'KuesionerController@_getAnswer');
    Route::get('kuesioner/get-kuesioner-tipe-c', 'KuesionerController@_getKuesionerTipeC');
    Route::get('kuesioner/get-by/{group}/{type}', 'KuesionerController@_getBy');
    Route::get('kuesioner/{id}/setting', 'KuesionerController@_showSetting');
    Route::get('kuesioner/{id}/show', 'KuesionerController@_show');
    Route::get('kuesioner/create', 'KuesionerController@create');
    Route::get('kuesioner', 'KuesionerController@index');
    
    Route::get('report/detail', 'ReportController@detail');
    Route::get('report', 'ReportController@index');
    Route::get('dashboard/download', 'HomeController@download');
    Route::get('dashboard/filter', 'HomeController@filter');
    Route::post('dashboard/save-layout', 'HomeController@saveLayout');

    
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/group-kuesioner', 'APIController@getGroupKuesioner');
    Route::get('/kuesioner', 'APIController@getKuesioner');
    Route::get('/kuesioner/{group}', 'APIController@getKuesionerGroup');
    Route::get('/kuesioner/group/{group_name}', 'APIController@getKuesionerGroupName');
});

Route::get('/home', 'HomeController@index');
Auth::routes();

