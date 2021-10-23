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

//blog post comment

Route::post('blog-post-comment','App\Http\Controllers\CommentController@postCommentAdd')->name('post.comment');
Route::post('blog-comment-reply','App\Http\Controllers\CommentController@postCommentReply')->name('post.reply');


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


        //products brand


        Route::resource('brand','App\Http\Controllers\BrandController');
        Route::get('brand/status-inactive/{id}','App\Http\Controllers\BrandController@brandStatusInactive');
        Route::get('brand/status-active/{id}','App\Http\Controllers\BrandController@brandStatusActive');
        Route::get('brand-delete/{id}','App\Http\Controllers\BrandController@brandDelete');
        Route::get('brand-edit/{id}','App\Http\Controllers\BrandController@brandEdit');

        //product category

        Route::resource('product-category','App\Http\Controllers\ProductCategoryController');
        Route::get('product-category-delete/{id}','App\Http\Controllers\ProductCategoryController@categoryProductDelete')->name('Pcat.delete');
        Route::get('product-category-edit/{id}','App\Http\Controllers\ProductCategoryController@categoryProductEdit')->name('Pcat.edit');
        Route::post('product-category-update','App\Http\Controllers\ProductCategoryController@categoryProductUpdate')->name('Pcat.update');

    //product tag

        Route::resource('product-tag','App\Http\Controllers\ProdcttagController');
        Route::get('product-tag-inactive/{id}','App\Http\Controllers\ProdcttagController@ptagInctive');
        Route::get('product-tag-active/{id}','App\Http\Controllers\ProdcttagController@ptagActive');
        Route::get('product-tag-edit/{id}','App\Http\Controllers\ProdcttagController@ptagEdit')->name('product.tag.edit');
        Route::post('product-tag-update/{id}','App\Http\Controllers\ProdcttagController@ptagupdate')->name('product.tag.edit');

        //product

        Route::resource('product','App\Http\Controllers\ProductController');




    });




