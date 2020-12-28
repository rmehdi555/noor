<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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


Route::middleware('language','visit')->group(function (){
    //Auth::routes();

    Route::get('/test',function (){
        event(new \App\Events\UserActivation(\App\User::find(5)));
    })->name('web.home');

    Route::get('index','HomeController@index')->name('web.index');
    Route::get('/','HomeController@index')->name('web.home');
    Route::get('/category/{id}','HomeController@showCategory')->name('web.show.category');
    Route::get('/product/{id}','HomeController@showProduct')->name('web.show.product');

    Route::get('/news/{id}','HomeController@showNews')->name('web.show.news');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/active/email/{token}', 'UserController@activationAccountByEmail')->name('activation.account.by.email');
    Route::POST('/user/active/sme', 'UserController@activationAccountBySMS')->name('web.activation.account.by.sms');
    Route::POST('/user/reset/password/code/sme', 'UserController@resetPasswordBySMS')->name('web.reset.password.by.sms');

    Route::get('/show/page/{id}','HomeController@showPage')->name('web.show.page');

    //contact us
    Route::get('/contact-us','ContactUsController@index')->name('web.contact.us.index');
    Route::post('/contact-us','ContactUsController@insert')->name('web.contact.us.insert');

    //complaint
    Route::get('/complaint','ComplaintController@index')->name('web.complaint.index');
    Route::post('/complaint','ComplaintController@insert')->name('web.complaint.insert');


    //fields
    Route::get('/fields','FieldController@index')->name('web.fields');
    Route::get('/field/{id}','FieldController@show')->name('web.show.field');



    //student
    Route::get('/students/level/1','StudentsController@level1')->name('web.students.level.1');
    Route::post('/students/level/1/save','StudentsController@level1Save')->name('web.students.level.1.save');
    Route::get('/students/level/1/cancel','StudentsController@level1Cancel')->name('web.students.level.1.cancel');
    Route::post('/students/field/add','StudentsFieldsController@add')->name('web.students.field.add');
    Route::get('/students/field/delete/{id}','StudentsFieldsController@delete')->name('web.students.field.delete');
    Route::get('/students/level/2','StudentsController@level2')->name('web.students.level.2');
    Route::post('/students/level/2/save','StudentsController@level2Save')->name('web.students.level.2.save');


    //teacher
    Route::get('/teachers/level/1','TeachersController@level1')->name('web.teachers.level.1');
    Route::get('/teachers/level/1/cancel','TeachersController@level1Cancel')->name('web.teachers.level.1.cancel');
    Route::get('/teachers/level/2','TeachersController@level2')->name('web.teachers.level.2');
    Route::post('/teachers/level/2/save','TeachersController@level2Save')->name('web.teachers.level.2.save');


    //noor
    Route::get('/noor/level/1','NoorController@level1')->name('web.noor.level.1');
    Route::get('/noor/level/1/cancel','NoorController@level1Cancel')->name('web.noor.level.1.cancel');
    Route::get('/noor/level/2','NoorController@level2')->name('web.noor.level.2');
    Route::post('/noor/level/1/save','NoorController@level1Save')->name('web.noor.level.1.save');
    Route::post('/noor/level/2/save','NoorController@level2Save')->name('web.noor.level.2.save');



    // error page

    Route::get('/404', 'HomeController@web404')->name('web.404');
    Route::get('/500', 'HomeController@web500')->name('web.500');

});


// start lang route
//Route::get('/lang/{locale}','HomeController@changeLang')->name('web.change.lang');
Route::get('/lang/{locale}',function($lang){
    \Session::put('locale',$lang);
    //dd(session('locale'));
    return redirect()->back();
})->name('web.change.lang');

//end lang route

// start currency route
Route::get('/currency/{currency}','HomeController@changeCurrency')->name('web.change.currency');
// end currency route



// start admin  route

Route::middleware('auth','checkAdmin')->namespace('Admin')->prefix('admin')->group(function (){
    Route::get('panel','PanelController@index')->name('admin.panel');
    //Route::resource('products','ProductsController');
    Route::resource('siteDetails','SiteDetailsController');
    //Route::resource('productCategories','ProductCategoriesController');
    Route::resource('slider','SliderController');
    Route::resource('webPages','WebPagesController');
    Route::resource('menus','MenuController');
    Route::resource('menuCategories','MenuCategoriesController');
    Route::resource('contactUs','ContactUsController');
    Route::resource('complaint','ComplaintController');
    Route::get('/panel/upload-image','PanelCotroller@uploadImageSubject');
    Route::resource('newsCategories','NewsCategoriesController');
    Route::resource('news','NewsController');
    Route::resource('fields','FieldController');
    Route::resource('students','StudentsController');
    Route::resource('teachers','TeachersController');
    Route::resource('noors','NoorsController');
});

// end admin  route


// start auth route
Route::middleware('language','visit')->namespace('Auth')->group(function (){
    // Authentication Routes...
    //Route::get('login', 'LoginController@showLoginForm')->name('login');
    //Route::post('login', 'LoginController@login');


    Route::get('login', 'LoginSmsController@showLoginForm')->name('login');
    Route::get('login/sms', 'LoginSmsController@showLoginForm')->name('login.sms');
    Route::post('login/sms', 'LoginSmsController@login');

    Route::get('logout', 'LoginController@logout')->name('logout');


    // Registration Routes...
 //   Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
   // Route::post('register', 'RegisterController@register');

   // Route::get('register/sms', 'RegisterSmsController@showRegistrationForm')->name('register.sms');
   // Route::post('register/sms', 'RegisterSmsController@register');

    Route::post('activation/account/sms', 'RegisterSmsController@showActivationAccontSms')->name('activation.account.sms');

    // Password Reset Routes...
   // Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
   // Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
   // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
   // Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    // Password Reset By SMS Routes
    Route::get('password/sms/reset', 'ForgotPasswordSmsController@showLinkRequestForm')->name('password.request.sms');
    Route::post('password/sms', 'ForgotPasswordSmsController@sendResetLinkSms')->name('password.sms');
    Route::get('password/reset/code/sms', 'ResetPasswordSmsController@showResetForm')->name('password.reset.sms');
    Route::post('password/update/sms/reset', 'ResetPasswordSmsController@reset')->name('password.update.sms');


});

// end auth route

// start user  route

Route::middleware('auth','language','visit')->namespace('User')->prefix('user')->group(function (){
    Route::get('panel','PanelController@index')->name('user.panel');
});

// end user  route

// start student  route

Route::middleware('auth','language','visit','checkStudent')->namespace('Student')->prefix('student')->group(function (){
    Route::get('panel','PanelController@index')->name('student.panel');
    Route::post('level/1/save','PanelController@level1Save')->name('student.level.1.save');
    Route::get('payment','PaymentController@index')->name('student.payment.index');
    Route::post('level/4/save','PanelController@level4Save')->name('student.level.4.save');
});

// end student  route
// start teacher  route

Route::middleware('auth','language','visit','checkTeacher')->namespace('Teacher')->prefix('teacher')->group(function (){
    Route::get('panel','PanelController@index')->name('teacher.panel');
    Route::post('level/1/save','PanelController@level1Save')->name('teacher.level.1.save');
    Route::post('level/2/save','PanelController@level2Save')->name('teacher.level.2.save');
    Route::post('level/3/save','PanelController@level3Save')->name('teacher.level.3.save');
    Route::get('payment','PaymentController@index')->name('teacher.payment.index');
});

// end teacher  route





//start ckfinder route

Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

//end ckfinder route




// start route payment

Route::get('payment/online/zarinpal','PaymentController@payZarinpal')->name('web.payment.online.zarinpal');
Route::get('payment/online/zarinpal/callback','PaymentController@payZarinpalCallback')->name('web.payment.online.zarinpal.callback');
Route::get('payment/online/zarinpal/callback/teacher','PaymentController@payZarinpalCallbackTeacher')->name('web.payment.online.zarinpal.callback.teacher');
Route::get('payment/online/zarinpal/callback/noor','PaymentController@payZarinpalCallbackNoor')->name('web.payment.online.zarinpal.callback.noor');


Route::post('payment/online/meli','PaymentController@payMelil')->name('web.payment.online.meli');
Route::post('payment/online/meli/callback','PaymentController@payMelilCallback')->name('web.payment.online.meli.callback');
Route::post('payment/online/meli/callback/teacher','PaymentController@payMelilCallbackTeacher')->name('web.payment.online.meli.callback.teacher');
Route::post('payment/online/meli/callback/noor','PaymentController@payMelilCallbackNoor')->name('web.payment.online.meli.callback.noor');
// end route payment