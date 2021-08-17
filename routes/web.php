<?php

use Illuminate\Support\Facades\Route;

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

   Route::post('/pusher/auth/jamil', function () {
    return Auth::check();
   });

   Route::get('/', function () {
    return view('admin.login');
   });

    Route::get('/termsconditions-and-privacy', 'Admin\HomeController@termsAndPrivacy')->name('terms&conditions');

    Route::get('/admin/login', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('adminDashboard');
    }
    return view('admin.login');
    })->name('showAdminLogin');

    Route::post('/admin/login', 'Admin\HomeController@login')->name('AdminLogin');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {

    //Admin dashboards
    Route::get('/dashboard', 'dashboardController@index')->name('adminDashboard');
    Route::get('/account', 'dashboardController@account')->name('adminAccount');
    Route::post('/account/update', 'dashboardController@UpdateAccount')->name('adminAccountUpdate');
    
    //Manage TemplateCategory
    Route::group(['prefix' => 'template/category'], function () {
      Route::get('/create', 'TemplateCategoryController@create')->name('templateCategoryCreate');
      Route::post('/store', 'TemplateCategoryController@store')->name('templateCategoryStore');
      Route::get('/edit/{id}', 'TemplateCategoryController@edit')->name('templateCategoryEdit');
      Route::post('/update/{id}', 'TemplateCategoryController@update')->name('templateCategoryUpdate');
      Route::get('/list', 'TemplateCategoryController@index')->name('templateCategoryList');
      Route::get('/remove/{id}', 'TemplateCategoryController@remove')->name('templateCategoryRemove');
    });
        
    //Manage Template
    Route::group(['prefix' => 'template'], function () {
      Route::get('/create', 'TemplateController@create')->name('templateCreate');
      Route::post('/store', 'TemplateController@store')->name('templateStore');
      Route::get('/edit/{id}', 'TemplateController@edit')->name('templateEdit');
      Route::post('/update/{id}', 'TemplateController@update')->name('templateUpdate');
      Route::get('/list', 'TemplateController@index')->name('templateList');
      Route::get('/remove/{id}', 'TemplateController@remove')->name('templateRemove');
    });

   //Manage Template Options
    Route::group(['prefix' => 'template/option'], function () {
      Route::get('/create', 'TemplateOptionController@create')->name('templateoptionsCreate');
      Route::post('/store', 'TemplateOptionController@store')->name('templateoptionsStore');
      Route::get('/edit/{id}', 'TemplateOptionController@edit')->name('templateoptionsEdit');
      Route::post('/update/{id}', 'TemplateOptionController@update')->name('templateoptionsUpdate');
      Route::get('/list', 'TemplateOptionController@index')->name('templateoptionsList');
      Route::get('/remove/{id}', 'TemplateOptionController@remove')->name('templateoptionsRemove');
    });

     //Manage Company 
    Route::group(['prefix' => 'company'], function () {      
       Route::get('/list', 'CompanyController@index')->name('company-list');
       Route::get('/create', 'CompanyController@create')->name('create_company');
       Route::post('/store', 'CompanyController@store')->name('store_company');
       Route::post('reset-password', 'CompanyController@resetPassword')->name('reset_company_password');
       Route::post('update-status', 'CompanyController@updateStatus')->name('update_company_status');
    });

    // Manage Reports
    Route::group(['prefix' => 'reports'], function(){
       Route::get('/', 'ReportController@index')->name('admin.reports');
      //  Route::get('/load-more', 'ReportController@loadMoreCompanies')->name('admin.reports.loadMore');
       Route::get('/by-location/{companyId}/{locationId?}', 'ReportController@byLocation')->name('admin.reports.by_location');
       Route::get('by-location/{locationId}/survey/{surveyId}', 'ReportController@surveyByLocation')->name('admin.reports.survey.by_location');
       Route::get('export/{surveyId}/location/{locationId}', 'ReportController@exportByLocation')->name('admin.export.by-location');
       Route::get('show/{reportId}', 'ReportController@show')->name('admin.reports.show');
       Route::get('show/{surveyId}/question/{questionId}', 'ReportController@surveyQuestion')->name('admin.reports.show.question');
       Route::get('show/{surveyId}/question/{questionId}/by-location/{locationId}', 'ReportController@surveyQuestionByLocation')->name('admin.reports.show.question.by_location');
       Route::get('export/{surveyId}', 'ReportController@export')->name('admin.export');
       Route::group(['prefix' => 'company'], function(){
        Route::get('/{companyId}/responses', 'ResponseController@index')->name('admin.reports.company.responses');
      });
    });

    //Admin logout
    Route::post('/adminLogout', 'HomeController@logout')->name('adminLogout');
});

    Route::group(['prefix' => 'company','middleware' => 'company', 'namespace' => 'Company'], function () {
      Route::post('/companyLogout', 'CompanyController@logout')->name('companylogout');

      //Manage Locations
      Route::group(['prefix' => 'location'], function () {      
        Route::get('/create', 'LocationController@create')->name('locationCreate');
        Route::post('/store', 'LocationController@store')->name('locationStore');
        Route::get('/edit/{id}', 'LocationController@edit')->name('locationEdit');
        Route::match(['post','get'],'/update/{id}', 'LocationController@update')->name('locationUpdate');
        Route::get('/list', 'LocationController@index')->name('LocationList');
        Route::get('/remove/{id}', 'LocationController@remove')->name('locationRemove');
        Route::post('active-inactive/{id}', 'LocationController@activeInactive')->name('active_inactive');
      });

      //Manage Devices
      Route::group(['prefix' => 'device'], function () {      
        Route::get('/create', 'DeviceController@create')->name('deviceCreate');
        Route::post('/store', 'DeviceController@store')->name('deviceStore');
        Route::get('/edit/{id}', 'DeviceController@edit')->name('deviceEdit');
        Route::match(['post','get'],'/update/{id}', 'DeviceController@update')->name('deviceUpdate');
        Route::get('/list', 'DeviceController@index')->name('deviceList');
        Route::get('/remove/{id}', 'DeviceController@remove')->name('deviceRemove');
        Route::get('/generate/qr/code/{id}', 'DeviceController@generate_QrCode')->name('generate-qrcode');
      });


      // Manage survey on Company Portal
      Route::group(['prefix' => 'survey'], function () {      
        Route::get('/create', 'CompanySurveyController@add')->name('companySurvey');
        Route::post('/store', 'CompanySurveyController@store')->name('addsurvey');
        Route::get('/edit/{id}', 'CompanySurveyController@edit')->name('editSurvey');
        Route::post('/update/{id}', 'CompanySurveyController@update')->name('updateSurvey');
        Route::get('/list', 'CompanySurveyController@index')->name('surveyList');
        Route::get('/remove/{id}', 'CompanySurveyController@remove')->name('surveyRemove');
        Route::get('/template/list', 'CompanySurveyController@getCategoriesWithTemplates')->name('getAlltemplates');
        Route::post('/template/option/list', 'CompanySurveyController@getTemplateOptions')->name('gettemplatesoptions');
        Route::post('/question/store', 'CompanySurveyController@storequestion_with_options')->name('addQuestion');
        Route::post('/devices/deploy', 'CompanySurveyController@DeploySurveyOnDevice')->name('deploySurveyOnDevices');

        Route::post('active-inactive/{id}', 'CompanySurveyController@activeInactive')->name('active_inactive');
    
            // Manage questions  on Company Portal
            Route::group(['prefix' => 'question'], function () {      
              Route::get('/list/{id}', 'QuestionController@index')->name('getAllQuestions');  
              Route::post('/remove', 'QuestionController@destroy')->name('remove_question');  
            });
      });

      /* Manage Reports*/
      Route::group(['prefix' => 'reports'], function(){
        Route::get('/', 'ReportController@index')->name('company.reports');
        Route::get('show/{surveyId}', 'ReportController@show')->name('company.reports.show');
        Route::get('overall/survey/{surveyId}', 'ReportController@overallSurveyReport')->name('company.reports.overall.survey');
        Route::get('show/{surveyId}/question/{questionId}', 'ReportController@surveyQuestion')->name('company.reports.show.question');
        Route::get('by-location/{locationId?}', 'ReportController@byLocation')->name('company.reports.by_location');
        Route::get('by-location/{locationId}/survey/{surveyId}', 'ReportController@surveyByLocation')->name('company.reports.survey.by_location');
        Route::get('show/{surveyId}/question/{questionId}/by-location/{locationId}', 'ReportController@surveyQuestionByLocation')->name('company.reports.show.question.by_location');
        Route::get('export/{surveyId}', 'ReportController@export')->name('company.export');
        Route::get('export/{surveyId}/location/{locationId}', 'ReportController@exportByLocation')->name('company.export.by-location');
        Route::get('/survey/{surveyId}/feedbacks', 'ResponseController@index')->name('company.survey.feedbacks');
        Route::get('/survey/{surveyId}/location/{locationId}/feedbacks', 'ResponseController@surveyResponseByLocation')->name('company.survey.feedbacks.by-location');
        Route::get('/survey/feedbacks/show/{feedbackId}', 'ResponseController@show')->name('company.survey.feedback.detail');
      });

      //Manage Dashboard
      Route::get('/dashboard/{companyId?}', 'DashboardController@index')->name('companyDashboard');

      //Manage Company Settings
      Route::group(['prefix' => 'setting'], function () {      
        Route::get('/edit', 'CompanySettingController@edit')->name('edit-companySettings');
        Route::post('/update/{id}', 'CompanySettingController@update')->name('update-companySettings');
      });

      //Manage Company Settings
      Route::group(['prefix' => 'profile'], function () {      
        Route::get('/edit', 'CompanyController@edit')->name('edit-companyProfile');
        Route::match(['get', 'post'],'/update/{id}', 'CompanyController@update')->name('update-companyProfile');
      });
      
    });

    Route::get('company/verify/', "Company\CompanyController@company_verification");
    Route::post('/set-password', 'Company\CompanyController@set_password')->name('set-password');
    Route::get('/company/login', 'Company\CompanyController@login')->name('company-login');
    Route::post('/store-company-login', 'Company\CompanyController@add_login')->name('store-company-login');

    //Manage FeedBack 
    Route::group(['prefix' => 'company/feedback/question/list'], function(){
        Route::get('/{deviceId}', 'Company\FeedbackController@index')->name('question-list');
        Route::post('/create_feedBack', 'Company\FeedbackController@create_feedBack')->name('create_feedBack');
        Route::post('/create/multiple/feedBack', 'Company\FeedbackController@create_multiple_feedback')->name('create_multiple_feedback');
        Route::post('/update_feedBack', 'Company\FeedbackController@update_feedBack')->name('update_feedBack');
        Route::post('/create_customer', 'Company\FeedbackController@create_customer')->name('create_customer');      
    });