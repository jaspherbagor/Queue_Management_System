<?php

use App\Http\Controllers\Admin\DatabaseController;
use App\Http\Controllers\Admin\ImageAdvertisementController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Front\HomeController;
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

# -----------------------------------------------------------
# LOGIN
# -----------------------------------------------------------
# login
Route::get('/', 'Common\LoginController@login');
Route::get('/', 'Common\LoginController@login')->name('login');
Route::post('login', 'Common\LoginController@checkLogin');
Route::get('logout', 'Common\LoginController@logout')->name('logout');
# login - {provider: google}
Route::get('login/{provider}', 'Common\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Common\LoginController@handleProviderCallback');


# -----------------------------------------------------------
# CLEAN CACHE
# -----------------------------------------------------------
Route::get('clean', function () {
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    // \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    dd('Cached Cleared');
});


# -----------------------------------------------------------
# COMMON
# -----------------------------------------------------------
Route::prefix('common')
    ->namespace('Common')
    ->group(function() {

	# display
	Route::get('display','DisplayController@display');
	Route::post('display1', 'DisplayController@display1');
	Route::post('display2','DisplayController@display2');
	Route::post('display3','DisplayController@display3');
	Route::post('display3b','DisplayController@display3b')->name('display3b');
	Route::post('display4','DisplayController@display4');
	Route::post('display5','DisplayController@display5');

	# -----------------------------------------------------------
	# AUTHORIZED COMMON
	# -----------------------------------------------------------
	Route::middleware('auth')
	    ->group(function() {
		# profile
		Route::get('setting/profile','ProfileController@profile');
		Route::get('setting/profile/edit','ProfileController@profileEditShowForm');
		Route::post('setting/profile/edit','ProfileController@updateProfile');
	});
});

# -----------------------------------------------------------
# AUTHORIZED
# -----------------------------------------------------------
Route::group(['middleware' => ['auth']], function() {

	# -----------------------------------------------------------
	# ADMIN
	# -----------------------------------------------------------
	Route::prefix('admin')
	    ->namespace('Admin')
	    ->middleware('roles:admin')
	    ->group(function() {
		# home
		Route::get('/', 'HomeController@home')->name('admin_home');

		# user
		Route::get('user', 'UserController@index')->name('users');
		Route::post('user/data', 'UserController@userData');
		Route::get('user/create', 'UserController@showForm');
		Route::post('user/create', 'UserController@create');
		Route::get('user/view/{id}','UserController@view');
		Route::get('user/edit/{id}','UserController@showEditForm');
		Route::post('user/edit','UserController@update');
		Route::get('user/delete/{id}','UserController@delete');

		# department
		Route::get('department','DepartmentController@index')->name('department');
		Route::get('department/create','DepartmentController@showForm');
		Route::post('department/create','DepartmentController@create');
		Route::get('department/edit/{id}','DepartmentController@showEditForm');
		Route::post('department/edit','DepartmentController@update');
		Route::get('department/delete/{id}','DepartmentController@delete');

		# counter
		Route::get('counter','CounterController@index')->name('counter');
		Route::get('counter/create','CounterController@showForm');
		Route::post('counter/create','CounterController@create');
		Route::get('counter/edit/{id}','CounterController@showEditForm');
		Route::post('counter/edit','CounterController@update');
		Route::get('counter/delete/{id}','CounterController@delete');

		# token
		Route::get('token/setting','TokenController@tokenSettingView');
		Route::post('token/setting','TokenController@tokenSetting');
		Route::get('token/setting/delete/{id}','TokenController@tokenDeleteSetting');
		Route::get('token/auto','TokenController@tokenAutoView');
		Route::post('token/auto','TokenController@tokenAuto');
		Route::get('token/current','TokenController@current');
		Route::get('token/report','TokenController@report')->name('token_report');
		Route::post('token/report/data','TokenController@reportData');
		Route::get('token/performance','TokenController@performance');
		Route::get('token/create','TokenController@showForm');
		Route::post('token/create','TokenController@create');
		Route::post('token/print', 'TokenController@viewSingleToken');
		Route::get('token/complete/{id}','TokenController@complete');
		Route::get('token/stoped/{id}','TokenController@stoped');
		Route::get('token/recall/{id}','TokenController@recall');
		Route::get('token/delete/{id}','TokenController@delete');
		Route::post('token/transfer','TokenController@transfer');
		Route::get('token/report-detail/{id}', [TokenController::class, 'report_detail'])->name('report_detail');
        Route::get('/token/delete-all/{id}', [TokenController::class, 'delete_all_numbers'])->name('delete_all_numbers');

		# setting
		Route::get('setting','SettingController@showForm');
		Route::post('setting','SettingController@create');
		Route::get('setting/display','DisplayController@showForm');
		Route::post('setting/display','DisplayController@setting');
		Route::get('setting/display/custom','DisplayController@getCustom');
		Route::post('setting/display/custom','DisplayController@custom');

		#ads
		Route::get('/setting/ads/view', [ImageAdvertisementController::class, 'index'])->name('ads_view');

		Route::get('/setting/ads/add', [ImageAdvertisementController::class, 'add'])->name('ads_add');

		Route::post('/setting/ads/submit', [ImageAdvertisementController::class, 'submit'])->name('ads_submit');

		Route::get('/setting/ads/delete/{id}', [ImageAdvertisementController::class, 'delete'])->name('ads_delete');
		
		# Database Routes
		Route::get('/database/backup-and-restore', [DatabaseController::class, 'index'])->name('backup_and_restore');
		Route::get('/database/backup-database',[ DatabaseController::class, 'backupDatabase'])->name('backup_database');
		Route::post('/database/restore', [DatabaseController::class, 'restoreDatabase'])->name('restore_database');
		Route::get('/database/backup-files', [DatabaseController::class, 'showBackups'])->name('show_backup');
		Route::get('/database/backup-file/download/{filename}', [DatabaseController::class, 'downloadBackup'])->name('download_backup');
	});

	# -----------------------------------------------------------
	# OFFICER
	# -----------------------------------------------------------
	Route::prefix('officer')
	    ->namespace('Officer')
	    ->middleware('roles:officer')
	    ->group(function() {
		# home
		Route::get('/', 'HomeController@home')->name('officer_home');
		# user
		Route::get('user/view/{id}', 'UserController@view');

		# token
		Route::get('token','TokenController@index')->name('officer_token_data');
		Route::post('token/data','TokenController@tokenData');
		Route::get('token/current','TokenController@current')->name('officer_current_token');
		Route::get('token/complete/{id}','TokenController@complete');
		Route::get('token/recall/{id}','TokenController@recall');
		// Route::post('token/recall/{id}', [TokenController::class, 'recall'])->name('token.recall');
		Route::get('token/stoped/{id}','TokenController@stoped');
		Route::post('token/print', 'TokenController@viewSingleToken');
	});

	# -----------------------------------------------------------
	# RECEPTIONIST
	# -----------------------------------------------------------
	Route::prefix('receptionist')
	    ->namespace('Receptionist')
	    ->middleware('roles:receptionist')
	    ->group(function() {
		# home
		Route::get('/','TokenController@tokenAutoView')->name('receptionist_home');

		# token
		Route::get('token/auto','TokenController@tokenAutoView');
		Route::post('token/auto','TokenController@tokenAuto');
		Route::get('token/create','TokenController@showForm');
		Route::post('token/create','TokenController@create');
		Route::get('token/current','TokenController@current');
		Route::post('token/print', 'TokenController@viewSingleToken');
	});

	# -----------------------------------------------------------
	# CLIENT
	# -----------------------------------------------------------
	Route::prefix('client')
	    ->namespace('Client')
	    ->middleware('roles:client')
	    ->group(function() {
		# home
		Route::get('/', function(){
			echo "<pre>";
			echo "<a href='".url('logout')."'>Logout</a>";
			echo "<br/>";
			print_r(auth()->user());
			return "Hello Client!";
		});
	});
});

// Authentication Routes
Route::get('/forgot-password', [AuthenticationController::class, 'forgot_password'])->name('forgot_password');

Route::post('/forgot-password-submit', [AuthenticationController::class, 'forgot_password_submit'])->name('forgot_password_submit');

Route::get('/reset-password/{token}/{email}', [AuthenticationController::class, 'reset_password'])->name('reset_password');

Route::post('/reset-password-submit', [AuthenticationController::class, 'reset_password_submit'])->name('reset_password_submit');


Route::post('/admin/token/recall', [TokenController::class, 'recallToken']);
