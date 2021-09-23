<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index');

Auth::routes([
    'register' => FALSE,
]);

Route::prefix('home')->group(function () {
    Route::get('/', 'HomepageController@index')->name('home');
    Route::prefix('data')->group(function () {
        Route::get('/', 'DataController@index')->name('all_data');
        Route::get('/getDetail/{id}/{atasanid}', 'DataController@getDetailSuperior')->name('get_detail_data');
        Route::get('/allDataJson', 'DataController@getDataTables')->name('getAllDataJson');
        Route::get('/getName', 'DataController@getName')->name('getNameDataJson');
        Route::post('/addData', 'DataController@addData')->name('addDataPost');
        Route::post('/editData', 'DataController@updateData')->name('editDataPost');
        Route::post('/deleteData', 'DataController@deleteData')->name('deleteDataPost');
    });
});