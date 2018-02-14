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

Route::redirect('/', '/access');
Route::redirect('/admin', '/admin/home');

Route::prefix('access')->name('access.')->namespace('Access')->group(function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('login/{tokenRequest}', 'Auth\LoginController@showLoginForm')->name('login.token');

    Route::get('redirect/{tokenRequest}', 'HomeController@redirect')->name('redirect');
    
    Route::middleware('auth:access')->group(function () {
    
    });
});

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    Route::middleware('auth:admin')->group(function () {

    });
});



Route::prefix('admin')->group(function () {
    /**
     * Admins
     */
    Route::get('admins', 'AdminsController@index');
    Route::get('admins/create', 'AdminsController@create');
    Route::get('admins/{id}', 'AdminsController@show');
    Route::get('admins/{id}/edit', 'AdminsController@edit');
    Route::post('admins/store', 'AdminsController@store');
    Route::patch('admins/{id}', 'AdminsController@update');
    Route::delete('admins/{id}', 'AdminsController@destroy');  

    /**
     * Usuarios
     */
    Route::get('users', 'UsuariosController@index');
    Route::get('users/create', 'UsuariosController@create');
    Route::get('users/{id}', 'UsuariosController@show');
    Route::get('users/{id}/edit', 'UsuariosController@edit');
    Route::post('users/store', 'UsuariosController@store');
    Route::patch('users/{id}', 'UsuariosController@update');
    Route::delete('users/{id}', 'UsuariosController@destroy');

    /**
     * Sistemas
     */
    Route::get('systems', 'SistemasController@index');
    Route::get('systems/create', 'SistemasController@create');
    Route::get('systems/{id}', 'SistemasController@show');
    Route::get('systems/{id}/edit', 'SistemasController@edit');
    Route::post('systems/store', 'SistemasController@store');
    Route::patch('systems/{id}', 'SistemasController@update');
    Route::delete('systems/{id}', 'SistemasController@destroy');

    /**
     * Logs
     */
    Route::get('logs', 'LogsController@index');
    Route::get('logs/create', 'LogsController@create');
    Route::get('logs/{id}', 'LogsController@show');
    Route::get('logs/{id}/edit', 'LogsController@edit');
    Route::post('logs/store', 'LogsController@store');
    Route::patch('logs/{id}', 'LogsController@update');
    Route::delete('logs/{id}', 'LogsController@destroy');
    
    
});        
