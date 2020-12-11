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
    Route::resource('products','ProductsController');
    Route::resource('siteDetails','SiteDetailsController');
    Route::resource('productCategories','ProductCategoriesController');
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
});

// end admin  route


// start auth route
Route::middleware('language','visit')->namespace('Auth')->group(function (){
    // Authentication Routes...
    //Route::get('login', 'LoginController@showLoginForm')->name('login');
    //Route::post('login', 'LoginController@login');

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
});

// end student  route
// start teacher  route

Route::middleware('auth','language','visit','checkTeacher')->namespace('Teacher')->prefix('teacher')->group(function (){
    Route::get('panel','PanelController@index')->name('teacher.panel');
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