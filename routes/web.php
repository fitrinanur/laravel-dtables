
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

Route::get('/', function () {
    return view('welcome');
});

route::resource('contact', 'ContactController');
route::get('api.contact','ContactController@apiContact')->name('api.contact');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
