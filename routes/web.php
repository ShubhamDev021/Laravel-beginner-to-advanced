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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return "Hello World";
});

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