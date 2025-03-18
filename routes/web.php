<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::get('/greeting', function () {
    return "Hello World";
})->name('greet');

// Parameterized route: required parameter
Route::get('/greeting/{id}', function ($id) {
    return "User ID is " . $id;
});

// Parameterized route: optional parameter having default null value
Route::get('/greeting2/{name?}', function ($name = null) {
    return "User name is " . $name;
});

// Parameterized route: optional parameter having default string value
Route::get('/greeting3/{name?}', function ($name = "Shubham") {
    return "User name is " . $name;
});

// Adding constants to Routes: single constant
Route::get('user/{id}', function ($id) {
    return "User ID: " . $id;
})->where('id', '[0-9]+');

Route::get('user/{name}', function ($name) {
    return "User Name: " . $name;
})->where('id', '[A-Za-z]+');

// Adding constants to Routes: multiple constants
Route::get('user/{id}/{name}', function ($id, $name) {
    return "User ID: " . $id . " and User Name: " . $name;
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

// Redirect to another route
Route::redirect('/redirect-route', '/');

// Grouping of routes
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        return "This is admin's user route";
    });
    
    Route::get('/coupon', function () {
        return "This is admin's coupon route";
    });
});

//Fallback route: used to show this page when no route matches, typically used to handle 404 requests of application
Route::fallback(function () {
    return "Page not found!!!";
});

// Return view using view function
Route::get('/greeting4', function() {
    $name = "Shubham";
    $age = 28;
    return view('greeting')
    ->with(['name' => $name, 'age' => $age]);
});

// Return view using View Facades
Route::get('/greeting5', function() {
    $name = "Ayush";
    $age = 25;
    return View::make('greeting')
    ->with(['name' => $name, 'age' => $age]);
});

// Using view routes
Route::view('/greeting6', 'greeting', ['name' => "Akansha", 'age' => 30]);

Route::view('/page1', 'layouts.page1');
Route::view('/page2', 'layouts.page2');

Route::get('users', [UserController::class, 'index']);

Route::get('users/{user_id}', [UserController::class, 'find_user']);

Route::resource('/posts', PostController::class);