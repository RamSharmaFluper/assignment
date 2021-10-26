<?php
use Illuminate\Support\Facades\DB;



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

Route::get('/', function () {
    return redirect('/login');

});



// Test database connection

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-company', 'CompanyController@index')->name('add-company');
Route::post('/add-company', 'CompanyController@store')->name('add-company');
Route::get('/edit-company/{id}', 'CompanyController@edit')->name('edit-company');
Route::put('/update-company/{id}', 'CompanyController@update')->name('update-company');
Route::delete('/delete-company/{id}', 'CompanyController@destroy')->name('delete-company');

Route::get('/employees', 'EmployeeController@index')->name('employees');
Route::get('/add-employee', 'EmployeeController@create')->name('add-employee');
Route::post('/add-employee', 'EmployeeController@store')->name('add-employee');
Route::get('/edit-employee/{id}', 'EmployeeController@edit')->name('edit-employee');
Route::put('/update-employee/{id}', 'EmployeeController@update')->name('update-employee');
Route::delete('/delete-employee/{id}', 'EmployeeController@destroy')->name('delete-employee');

Route::get('lang/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('getDownload', 'HomeController@getDownload');



