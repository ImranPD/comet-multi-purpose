<?php

use Illuminate\Support\Facades\Auth;
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

//frontend blog page show

Route::get('blog',[App\Http\controllers\BlogPageController::class,'ShowBlogPage']);
Route::post('blog',[App\Http\controllers\BlogPageController::class,'ShowBlogSearch'])->name('blog.search');
Route::get('blog/category/{slug}',[App\Http\controllers\BlogPageController::class,'ShowCatBlogSearch'])->name('post.cat.search');
Route::get('blog/tag/{slug}',[App\Http\controllers\BlogPageController::class,'ShowTagBlogSearch'])->name('blog.tag.search');
Route::get('blog/{slug}',[App\Http\controllers\BlogPageController::class,'BlogSingle'])->name('blog.single');


//admin templetes

Route::get('admin/login',[App\Http\Controllers\AdminController::class,'showAdminLogin'])->name('admin.login');
Route::get('admin/register',[App\Http\Controllers\AdminController::class,'showAdminRegister'])->name('admin.register');



Route::post('admin/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('admin.login');
Route::post('admin/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('admin.logout');
Route::post('admin/register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('admin.register');


//middleware

    Route::group(['middleware'=>'auth'],function(){

        //admin dashboard

        Route::get('admin/dashboard',[App\Http\Controllers\AdminController::class,'showAdminDashboard'])->name('admin.dashboard');

        // all post

        Route::resource('post','App\Http\Controllers\PostController');
        Route::get('post/status-inactive/{id}','App\Http\Controllers\PostController@statusInactive');
        Route::get('post/status-active/{id}','App\Http\Controllers\PostController@stausActive');
        Route::get('post-trash','App\Http\Controllers\PostController@postTrash')->name('post.trash');
        Route::get('post-trash-update/{id}','App\Http\Controllers\PostController@postTrashUpdate')->name('post.trash.update');

        //post tag

        Route::resource('tag','App\Http\Controllers\TagController');
        Route::get('tag/status-inactive/{id}','App\Http\Controllers\TagController@statusUpdateInactive');
        Route::get('tag/status-active/{id}','App\Http\Controllers\TagController@statusUpdateActive');


        //post category
        Route::resource('category','App\Http\Controllers\CategoryController');
        Route::get('category/status-inactive/{id}','App\Http\Controllers\CategoryController@statusUpdateInactive');
        Route::get('category/status-active/{id}','App\Http\Controllers\CategoryController@statusUpdateActive');


    });



