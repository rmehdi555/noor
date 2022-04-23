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

Route::get('/noor-send-sms-monthly', function() {
    $output = [];
    \Illuminate\Support\Facades\Artisan::call('noor:monthly', $output);
    dd($output);
});

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
    Route::get('/news/category/{id}','HomeController@showNewsCategory')->name('web.show.news.category');

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
    Route::get('/noor/level/2/show/{id}/{mobile}','NoorController@noorLevel2Show')->name('web.noor.level.2.show');

    //mosabeghe maleke zaman
    Route::get('/mosabeghe','MosabegheMalekeZamanController@level1')->name('web.mosabeghe.maleke.zaman.level.1');
    Route::post('/mosabeghe/save/level/1','MosabegheMalekeZamanController@level1Save')->name('web.mosabeghe.maleke.zaman.level.1.save');

    // mosabeghe javab
    //Route::get('/mosabeghe/javab/login','MosabegheMalekeZamanController@level1')->name('web.mosabeghe.javab.login');
    Route::get('/mosabeghe/javab/login','MosabegheJavabController@login')->name('web.mosabeghe.javab.login');
    Route::post('/mosabeghe/javab/login/check','MosabegheJavabController@loginCheck')->name('web.mosabeghe.javab.login.check');
    Route::post('/mosabeghe/javab/test/save','MosabegheJavabController@testSave')->name('web.mosabeghe.javab.test.save');
    Route::post('/mosabeghe/javab/naghashi/save','MosabegheJavabController@naghashiSave')->name('web.mosabeghe.javab.naghashi.save');
    Route::post('/mosabeghe/nazar/save','MosabegheJavabController@nazarSave')->name('web.mosabeghe.nazar.save');
    Route::get('/mosabeghe/end','MosabegheJavabController@end')->name('web.mosabeghe.end');




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
    Route::post('/students/add/file/{id}','StudentsController@addFile')->name('students.add.file');
    Route::get('/reports/students','StudentsController@reports')->name('students.reports');
    Route::resource('teachers','TeachersController');
    Route::post('/teachers/add/file/{id}','TeachersController@addFile')->name('teachers.add.file');
    Route::get('/reports/teachers/specialization','TeachersController@reportsSpecialization')->name('teachers.reports.specialization');

    Route::resource('noors','NoorsController');
    Route::resource('mosabeghe','MosabegheMalekeZamanController');
    Route::resource('specialization','SpecializationController');

    // practice route admin panel
    Route::get('practice/list','PracticeController@list')->name('admin.practice.list');
    Route::get('practice/show/{id}','PracticeController@show')->name('admin.practice.show');
   // Route::get('practice/add','PracticeController@add')->name('admin.practice.add');
   // Route::post('practice/save','PracticeController@save')->name('admin.practice.save');
    Route::post('practice/save/ans','PracticeController@saveAns')->name('admin.practice.save.ans');

    // ticket route admin panel
    Route::get('ticket/list','TicketController@list')->name('admin.ticket.list');
    Route::get('ticket/show/{id}','TicketController@show')->name('admin.ticket.show');
//    Route::get('ticket/add','TicketController@add')->name('admin.ticket.add');
//    Route::post('ticket/save','TicketController@save')->name('admin.ticket.save');
    Route::post('ticket/save/ans','TicketController@saveAns')->name('admin.ticket.save.ans');

    // message route admin panel
    Route::get('message/list','MessageController@list')->name('admin.message.list');
    Route::get('message/show/{id}','MessageController@show')->name('admin.message.show');
    Route::get('message/add','MessageController@add')->name('admin.message.add');
    Route::post('message/save','MessageController@save')->name('admin.message.save');
    Route::post('message/delete','MessageController@delete')->name('admin.message.delete');

    Route::resource('methodOfLetter','MethodOfLetterController');
    Route::resource('meeting','MeetingController');

    Route::resource('depositsType','DepositsTypeController');
    Route::resource('deposits','DepositsController');


    //ایجاد کلاس جدید توسط ادمین
    Route::get('class/create','ClassController@create')->name('admin.class.create');
    Route::post('class/create/save','ClassController@createSave')->name('admin.class.create.save');
    Route::get('class/edit/{id}','ClassController@edit')->name('admin.class.edit');
    Route::post('class/edit/save','ClassController@editSave')->name('admin.class.edit.save');

   //ثبت نام قران آموز ها در کلاس مدنظر
    Route::get('class/register','ClassController@register')->name('admin.class.register');
    Route::post('class/register/save','ClassController@registerSave')->name('admin.class.register.save');
    Route::post('class/register/delete','ClassController@registerDelete')->name('admin.class.register.delete');
    Route::post('class/register/cancel','ClassController@registerCancel')->name('admin.class.register.cancel');
    Route::get('class/register/report','ClassController@registerReport')->name('admin.class.register.report');


    Route::post('class/register/teacher/delete','ClassController@registerTeacherDelete')->name('admin.class.register.teacher.delete');
    Route::get('class/list','ClassController@list')->name('admin.class.list');
    Route::get('class/show/{id}','ClassController@show')->name('admin.class.show');
    Route::post('class/delete','ClassController@delete')->name('admin.class.delete');
    Route::get('class/list/teacher/{id}','ClassController@listTeacher')->name('admin.class.list.teacher');


    // آزمون
    Route::get('exams/list','ExamsController@list')->name('admin.exams.list');
    Route::get('exams/create','ExamsController@create')->name('admin.exams.create');
    Route::post('exams/create/save','ExamsController@createSave')->name('admin.exams.create.save');
    Route::get('exams/show/{id}','ExamsController@show')->name('admin.exams.show');
    Route::get('exams/edit/{id}','ExamsController@edit')->name('admin.exams.edit');
    Route::post('exams/edit/save','ExamsController@editSave')->name('admin.exams.edit.save');

    Route::get('exams/questions/create/{id}','ExamsController@questionsCreate')->name('admin.exams.questions.create');
    Route::post('exams/questions/create/save','ExamsController@questionsCreateSave')->name('admin.exams.questions.create.save');
    Route::get('exams/questions/edit/{id}','ExamsController@questionsEdit')->name('admin.exams.questions.edit');
    Route::post('exams/questions/edit/save','ExamsController@questionsEditSave')->name('admin.exams.questions.edit.save');

    Route::post('exams/show/result','ExamsController@showResult')->name('admin.exams.show.result');
    Route::post('exams/show/result/save','ExamsController@showResultSave')->name('admin.exams.show.result.save');


    Route::post('act/list/show','ActListController@actListShow')->name('admin.act.list.show');
    Route::get('act/list/show','ActListController@actListShow')->name('admin.act.list.show');
    Route::post('act/list/save','ActListController@actListSave')->name('admin.act.list.save');
    Route::post('act/list/delete','ActListController@actListDelete')->name('admin.act.list.delete');

    Route::get('work/hours/show/{user_id}','WorkHoursController@show')->name('admin.work.hours.show');
    Route::post('work/hours/list/create/save','WorkHoursController@listCreateSave')->name('admin.work.hours.list.create.save');
    Route::get('work/hours/list/show','WorkHoursController@listShow')->name('admin.work.hours.list.show');
    Route::post('work/hours/list/delete','WorkHoursController@listDelete')->name('admin.work.hours.list.delete');
    Route::post('work/hours/list/pay','WorkHoursController@listPay')->name('admin.work.hours.list.pay');
    Route::get('work/hours/list/show/pay','WorkHoursController@listShowPay')->name('admin.work.hours.list.show.pay');
    Route::post('work/hours/list/show/details','WorkHoursController@listShowDetails')->name('admin.work.hours.list.show.details');


    Route::get('change-password', 'ChangePasswordController@index')->name('admin.change.password.index');;
    Route::post('change-password', 'ChangePasswordController@store')->name('admin.change.password.store');








});

// end admin  route


// start auth route
Route::middleware('language')->namespace('Auth')->group(function (){
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

Route::middleware('auth','language')->namespace('User')->prefix('user')->group(function (){
    Route::get('panel','PanelController@index')->name('user.panel');
});

// end user  route

// start student  route

Route::middleware('auth','language','checkStudent')->namespace('Student')->prefix('student')->group(function (){
    Route::get('panel','PanelController@index')->name('student.panel');
    Route::post('level/1/save','PanelController@level1Save')->name('student.level.1.save');
    Route::get('payment','PaymentController@index')->name('student.payment.index');
    Route::post('level/4/save','PanelController@level4Save')->name('student.level.4.save');
    Route::get('panel/print/details','PanelController@printDetails')->name('student.panel.print.details');

    Route::get('class/register','ClassController@register')->name('student.class.register');
    Route::post('class/register/save','ClassController@registerSave')->name('student.class.register.save');
    Route::post('class/register/field/add','StudentsFieldsController@add')->name('students.class.register.field.add');
    Route::get('class/register/field/delete/{id}','StudentsFieldsController@delete')->name('students.class.register.field.delete');

    Route::get('class/list','ClassController@list')->name('student.class.list');
    Route::get('mali/list','MaliController@list')->name('student.mali.list');

    Route::get('practice/list','PracticeController@list')->name('student.practice.list');
    Route::get('practice/show/{id}','PracticeController@show')->name('student.practice.show');
    Route::get('practice/add','PracticeController@add')->name('student.practice.add');
    Route::post('practice/save','PracticeController@save')->name('student.practice.save');
    Route::post('practice/save/ans','PracticeController@saveAns')->name('student.practice.save.ans');

    Route::get('ticket/list','TicketController@list')->name('student.ticket.list');
    Route::get('ticket/show/{id}','TicketController@show')->name('student.ticket.show');
    Route::get('ticket/add','TicketController@add')->name('student.ticket.add');
    Route::post('ticket/save','TicketController@save')->name('student.ticket.save');
    Route::post('ticket/save/ans','TicketController@saveAns')->name('student.ticket.save.ans');

    Route::get('message/list','MessageController@list')->name('student.message.list');
    Route::get('message/show/{id}','MessageController@show')->name('student.message.show');


    Route::get('deposits/create','DepositsController@create')->name('student.deposits.create');
    Route::post('deposits/save','DepositsController@save')->name('student.deposits.save');

    Route::get('exams/response/{id}','ExamsController@response')->name('student.exams.response');
    Route::post('exams/response/test/save','ExamsController@responseTestSave')->name('student.exams.response.test.save');
    Route::post('exams/response/adj/save','ExamsController@responseAdjSave')->name('student.exams.response.adj.save');


});

// end student  route
// start teacher  route

Route::middleware('auth','language','checkTeacher')->namespace('Teacher')->prefix('teacher')->group(function (){
    Route::get('panel','PanelController@index')->name('teacher.panel');
    Route::post('level/1/save','PanelController@level1Save')->name('teacher.level.1.save');
    Route::post('level/2/save','PanelController@level2Save')->name('teacher.level.2.save');
    Route::post('level/3/save','PanelController@level3Save')->name('teacher.level.3.save');
    Route::get('payment','PaymentController@index')->name('teacher.payment.index');

    Route::get('panel/print/details','PanelController@printDetails')->name('teacher.panel.print.details');

    //ایجاد کلاس جدید
    Route::get('class/create','ClassController@create')->name('teacher.class.create');
    Route::post('class/create/save','ClassController@createSave')->name('teacher.class.create.save');
    Route::get('class/edit/{id}','ClassController@edit')->name('teacher.class.edit');
    Route::post('class/edit/save','ClassController@editSave')->name('teacher.class.edit.save');
    //ثبت نام قران آموز ها در کلاس مدنظر
    Route::get('class/register','ClassController@register')->name('teacher.class.register');
    Route::post('class/register/save','ClassController@registerSave')->name('teacher.class.register.save');
    Route::post('class/register/delete','ClassController@registerDelete')->name('teacher.class.register.delete');
    Route::post('class/register/cancel','ClassController@registerCancel')->name('teacher.class.register.cancel');
    Route::post('class/register/teacher/delete','ClassController@registerTeacherDelete')->name('teacher.class.register.teacher.delete');


    Route::get('class/list','ClassController@list')->name('teacher.class.list');
    Route::get('class/show/{id}','ClassController@show')->name('teacher.class.show');
    //Route::get('mali/list','MaliController@list')->name('teacher.mali.list');


    Route::get('practice/list','PracticeController@list')->name('teacher.practice.list');
    Route::get('practice/show/{id}','PracticeController@show')->name('teacher.practice.show');
    Route::get('practice/add','PracticeController@add')->name('teacher.practice.add');
    Route::post('practice/save','PracticeController@save')->name('teacher.practice.save');
    Route::post('practice/save/ans','PracticeController@saveAns')->name('teacher.practice.save.ans');


    Route::get('ticket/list','TicketController@list')->name('teacher.ticket.list');
    Route::get('ticket/show/{id}','TicketController@show')->name('teacher.ticket.show');
    Route::get('ticket/add','TicketController@add')->name('teacher.ticket.add');
    Route::post('ticket/save','TicketController@save')->name('teacher.ticket.save');
    Route::post('ticket/save/ans','TicketController@saveAns')->name('teacher.ticket.save.ans');


    Route::get('message/list','MessageController@list')->name('teacher.message.list');
    Route::get('message/show/{id}','MessageController@show')->name('teacher.message.show');
    Route::get('message/add','MessageController@add')->name('teacher.message.add');
    Route::post('message/save','MessageController@save')->name('teacher.message.save');


    Route::get('methodOfLetter/list','MethodOfLetterController@list')->name('teacher.methodOfLetter.list');
    Route::get('meeting/list','MeetingController@list')->name('teacher.meeting.list');



    // آزمون
    Route::get('exams/list','ExamsController@list')->name('teacher.exams.list');
    Route::get('exams/create','ExamsController@create')->name('teacher.exams.create');
    Route::post('exams/create/save','ExamsController@createSave')->name('teacher.exams.create.save');
    Route::get('exams/show/{id}','ExamsController@show')->name('teacher.exams.show');
    Route::get('exams/edit/{id}','ExamsController@edit')->name('teacher.exams.edit');
    Route::post('exams/edit/save','ExamsController@editSave')->name('teacher.exams.edit.save');

    Route::get('exams/questions/create/{id}','ExamsController@questionsCreate')->name('teacher.exams.questions.create');
    Route::post('exams/questions/create/save','ExamsController@questionsCreateSave')->name('teacher.exams.questions.create.save');
    Route::get('exams/questions/edit/{id}','ExamsController@questionsEdit')->name('teacher.exams.questions.edit');
    Route::post('exams/questions/edit/save','ExamsController@questionsEditSave')->name('teacher.exams.questions.edit.save');


    Route::get('class/teacher/list','ClassController@teacherList')->name('teacher.class.teacher.list');


    Route::get('exams/response/{id}','ExamsController@response')->name('teacher.exams.response');
    Route::post('exams/response/test/save','ExamsController@responseTestSave')->name('teacher.exams.response.test.save');
    Route::post('exams/response/adj/save','ExamsController@responseAdjSave')->name('teacher.exams.response.adj.save');

    Route::post('exams/show/result','ExamsController@showResult')->name('teacher.exams.show.result');
    Route::post('exams/show/result/save','ExamsController@showResultSave')->name('teacher.exams.show.result.save');


    Route::post('act/list/show','ActListController@actListShow')->name('teacher.act.list.show');
    Route::get('act/list/show','ActListController@actListShow')->name('teacher.act.list.show');
    Route::post('act/list/save','ActListController@actListSave')->name('teacher.act.list.save');
    Route::post('act/list/delete','ActListController@actListDelete')->name('teacher.act.list.delete');
    Route::post('act/list/edit','ActListController@actListEdit')->name('teacher.act.list.edit');
    Route::post('act/list/edit/save','ActListController@actListEditSave')->name('teacher.act.list.edit.save');



    Route::get('card/number/bank/create','CardNumberBankController@create')->name('teacher.card.number.bank.create');
    Route::post('card/number/bank/create/save','CardNumberBankController@createSave')->name('teacher.card.number.bank.create.save');

    Route::get('work/hours','WorkHoursController@index')->name('teacher.work.hours');
    Route::post('work/hours/create/save','WorkHoursController@createSave')->name('teacher.work.hours.create.save');
    Route::post('work/hours/delete/save','WorkHoursController@deleteSave')->name('teacher.work.hours.delete.save');

    Route::get('deposits/create','DepositsController@create')->name('teacher.deposits.create');
    Route::post('deposits/save','DepositsController@save')->name('teacher.deposits.save');
    Route::post('deposits/student/show','DepositsController@studentShow')->name('teacher.deposits.student.show');

    Route::get('mali/list','MaliController@list')->name('teacher.mali.list');



    Route::get('work/hours/list/show','WorkHoursController@listShow')->name('teacher.work.hours.list.show');
    Route::post('work/hours/list/show/details','WorkHoursController@listShowDetails')->name('teacher.work.hours.list.show.details');





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
Route::get('payment/online/zarinpal/callback/student/class/register','PaymentController@payZarinpalCallbackStudentClassRegister')->name('payment.online.zarinpal.callback.student.class.register');
Route::get('payment/online/zarinpal/callback/student/deposit','PaymentController@payZarinpalCallbackStudentDeposit')->name('payment.online.zarinpal.callback.student.deposit');
Route::get('payment/online/zarinpal/callback/teacher/deposit','PaymentController@payZarinpalCallbackTeacherDeposit')->name('payment.online.zarinpal.callback.teacher.deposit');


Route::post('payment/online/meli','PaymentController@payMeli')->name('web.payment.online.meli');
Route::post('payment/online/meli/callback','PaymentController@payMeliCallback')->name('web.payment.online.meli.callback');
Route::post('payment/online/meli/callback/teacher','PaymentController@payMeliCallbackTeacher')->name('web.payment.online.meli.callback.teacher');
Route::post('payment/online/meli/callback/noor','PaymentController@payMeliCallbackNoor')->name('web.payment.online.meli.callback.noor');
Route::get('payment/online/meli/callback/noor','PaymentController@payMeliCallbackNoor')->name('web.payment.online.meli.callback.noor.get');
Route::post('payment/online/meli/callback/student/class/register','PaymentController@payMeliCallbackStudentClassRegister')->name('payment.online.meli.callback.student.class.register');
Route::post('payment/online/meli/callback/student/deposit','PaymentController@payMeliCallbackStudentDeposit')->name('payment.online.meli.callback.student.deposit');
Route::post('payment/online/meli/callback/teacher/deposit','PaymentController@payMeliCallbackTeacherDeposit')->name('payment.online.meli.callback.teacher.deposit');

// end route payment
