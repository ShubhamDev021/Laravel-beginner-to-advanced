<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::get('/posts/undo-soft-delete/{id}', [PostController::class, 'undo_soft_delete'])->name('posts.undo-soft-delete');

Route::get('insert-post', function () {
    Post::create([
        'title' => 'Laravel 11.1.2',
        'description' => 'Laravel 11.1.2 is cool',
        'is_active' => true,
        'is_published' => true
    ]);

    return "Data inserted successfully!!!";
});

Route::get('show-all-posts', function () {
    $posts = Post::all();
    return $posts;
});

Route::get('find-post-by-id/{id}', function ($id) {
    $post = Post::find($id);
    if (!$post) {
        return "Post not found!!!";
    }
    return $post;
});

Route::get('find-post-by-specific-condition/{value}', function ($value) {
    $post = Post::where('title', $value)->get();
    return $post;
});

Route::get('find-post-by-specific-conditions-AND/{value1}/{value2}', function ($value1, $value2) {
    //where() chaining method
    // $post = Post::where('title', $value1)
    //             ->where('is_active', $value2)
    //             ->get();

    //single where() method
    $post = Post::where(['title' => $value1, 'is_active' => $value2])
                ->get();

    return $post;
});

Route::get('find-post-by-specific-conditions-OR/{value1}/{value2}', function ($value1, $value2) {
    $post = Post::where('title', $value1)
                ->orwhere('is_active', $value2)
                ->get();

    return $post;
});

Route::get('update-post/{id}', function ($id) {
    $post = Post::find($id);
    $post->update([
        'title' => 'Laravel 9.1.2',
        'description' => 'This is new description of laravel 9.1.2'
    ]);

    return "Data updated successfully";
});

Route::get('delete-post/{id}', function ($id) {
    $post = Post::find($id);
    if (! $post) {
        return "Post not found!!!";
    }
    $post->delete();

    return "Data deleted successfully";
});

Route::get('session-using-facade', function () {
    // create a session
    Session::put('login', 'User logged in successfully');
    
    // delete login session
    Session::forget('login');

    // delete all sessions
    Session::flush();

    // check if session exists
    if (Session::has('login')) {
        return "Session exists";
    }
    else {
        return "Session doesn't exists";
    }
});

Route::get('query-builder-insert-post', function () {
    DB::table('posts')
    ->insert([
        'title' => 'My Second Post',
        'description' => 'This is the content of my second post.',
        'is_active' => 1,
        'is_published' => 1,
        'deleted_at' => null,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return "Data inserted successfully!!!";
});

Route::get('query-builder-show-all-posts', function () {
    $posts = DB::table('posts')
            ->get();

    return $posts;
});

Route::get('query-builder-find-post-by-id/{id}', function ($id) {
    $post = DB::table('posts')
            ->find($id);
    if (!$post) {
        return "Post not found!!!";
    }

    return $post;
});

Route::get('query-builder-find-post-by-specific-condition/{value}', function ($value) {
    $post = DB::table('posts')
            ->where('title', $value)
            ->get();

    return $post;
});

Route::get('query-builder-find-post-by-specific-conditions-AND/{value1}/{value2}', function ($value1, $value2) {
    //where() chaining method
    // $post = DB::table('posts')
    //         ->where('title', $value1)
    //         ->where('is_active', $value2)
    //         ->get();

    //single where() method
    $post = DB::table('posts')
            ->where([
                'title'     =>  $value1,
                'is_active' =>  $value2
            ])
            ->get();

    return $post;
});

Route::get('query-builder-find-post-by-specific-conditions-OR/{value1}/{value2}', function ($value1, $value2) {
    $post = DB::table('posts')
            ->where('title', $value1)
            ->orwhere('is_active', $value2)
            ->get();

    return $post;
});

Route::get('query-builder-update-post/{id}', function ($id) {
    $post = DB::table('posts')
            ->where('id', $id)
            ->update([
                'title' => 'Laravel 9',
                'description' => 'This is new description of laravel 9'
            ]);

    return "Data updated successfully";
});

Route::get('query-builder-delete-post/{id}', function ($id) {
    $post = DB::table('posts')
            ->where('id', $id)
            ->delete();

    return "Data deleted successfully";
});

Route::get('query-builder-raw-sql-query-insert-post', function () {
    DB::insert('insert into posts (title, description, is_active, is_published, deleted_at, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)', ['My Third Post', 'This is the content of my third post.', 0, 1, null, now(), now()]);

    return "Data inserted successfully!!!";
});

Route::get('query-builder-raw-sql-query-show-all-posts', function () {
    $posts = DB::select('select * from posts');

    return $posts;
});

Route::get('query-builder-raw-sql-query-find-post-by-specific-condition/{value1}/{value2}', function ($value1, $value2) {
    $post = DB::select('select * from posts where title = ? and is_active = ?', [$value1, $value2]);

    return $post;
});

Route::get('query-builder-raw-sql-query-update-post/{id}', function ($id) {
    DB::update('update posts set title = ? and description = ? where id = ?', ['Laravel 9', 'This is new description of laravel 9', $id]);

    return "Data updated successfully";
});