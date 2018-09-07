<?php

use Illuminate\Support\Facades\Input;
use App\Post;
use App\User;

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
	$active_users = User::active()->get();
    $posts = Post::search(Input::get('search'))->orderBy('created_at', 'desc')->paginate(6);
    return view('welcome', ['posts' => $posts, 'active_users' => $active_users]);
});

//Route::get('/user/{name}', function ($name) {
//  return 'The user name is '.$name;
//});

Route::get('/posts', 'PostsController@index')->name('posts.index');
Route::get('/post/{id}', 'PostsController@show')->name('posts.show');
Route::post('/posts', ['as' => 'store', 'uses' => 'PostsController@store']);
Route::get('/post/{id}/edit', 'PostsController@edit');
Route::patch('/post/{id}', 'PostsController@update')->name('posts.update');
Route::delete('/post/{id}', 'PostsController@destroy');


Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/news', function () {
    return view('news');
})->name('news');
Route::get('/projects', function () {
    return view('projects');
})->name('projects');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@profile')->name('user.profile');
Route::patch('/profile', 'UserController@update_profile')->name('user.profile.update');

Route::resource('comments', 'CommentsController');

Route::group(['middleware' => ['auth', 'role:administrator'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('/users', 'Admin\UsersController@index')->name('users.index');
  Route::post('/users/active_deactive', 'Admin\UsersController@activeDeactive')->name('users.active_deactive');
  Route::post('/users/change_role', 'Admin\UsersController@changeRole')->name('users.change_role');
});
