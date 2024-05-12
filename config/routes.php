<?php

use App\Core\Router\Route;
use App\Src\Controllers\Admin\AdminChangesController;
use App\Src\Controllers\Admin\AdminController;
use App\Src\Controllers\Admin\AdminPostsController;
use App\Src\Controllers\Admin\AdminUsersController;
use App\Src\Controllers\Blog\MainController;
use App\Src\Controllers\Blog\SessionController;
use App\Src\Controllers\Comment\AddCommentController;
use App\Src\Controllers\Comment\CommentsController;
use App\Src\Controllers\Post\AddPostController;
use App\Src\Controllers\Post\CategoryController;
use App\Src\Controllers\Post\PostController;
use App\Src\Controllers\User\AuthController;
use App\Src\Controllers\User\ProfileController;
use App\Src\Controllers\User\RegisterController;
use App\Src\Middlewares\AdminMiddleware;
use App\Src\Middlewares\AuthMiddleware;
use App\Src\Middlewares\GuestMiddleware;

return [
    Route::get('/', [MainController::class, 'index']),
    Route::get('/getPopularPosts', [PostController::class, 'getPopularPosts']),
    Route::get('/getSession', [SessionController::class, 'sendSession']),
    Route::get('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class]),
    Route::get('/register', [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/register', [RegisterController::class, 'register'], [GuestMiddleware::class]),
    Route::get('/login', [AuthController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]),
    Route::get('/profile', [ProfileController::class, 'index'], [AuthMiddleware::class]),
    Route::get('/getUser', [ProfileController::class, 'getUser'], [AuthMiddleware::class]),
    Route::post('/changeAvatar', [ProfileController::class, 'changeAvatar'], [AuthMiddleware::class]),
    Route::post('/deleteAvatar', [ProfileController::class, 'deleteAvatar'], [AuthMiddleware::class]),
    Route::get('/addPost', [AddPostController::class, 'index'], [AuthMiddleware::class]),
    Route::post('/addPost', [AddPostController::class, 'addPost'], [AuthMiddleware::class]),
    Route::get('/post/\d+', [PostController::class, 'index']),
    Route::get('/getPost/\d+', [PostController::class, 'getPost']),
    Route::post('/addComment/\d+', [AddCommentController::class, 'addComment'], [AuthMiddleware::class]),
    Route::get('/getComments/\d+', [CommentsController::class, 'getComments']),
    Route::get('/[a-zA-Z0-9]+/\d+', [CategoryController::class, 'index']),
    Route::get('/getPostsByCategory/[a-zA-Z0-9]+/\d+', [CategoryController::class, 'getPosts']),
    Route::get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]),
    Route::get('/admin/users', [AdminUsersController::class, 'index'], [AdminMiddleware::class]),
    Route::get('/admin/getUsers', [AdminUsersController::class, 'getUsers'], [AdminMiddleware::class]),
    Route::get('/admin/users/edit/\d+', [AdminUsersController::class, 'showEditUser'], [AdminMiddleware::class]),
    Route::post('/admin/users/edit/\d+', [AdminUsersController::class, 'editUser'], [AdminMiddleware::class]),
    Route::post('/admin/users/delete/\d+', [AdminUsersController::class, 'deleteUser'], [AdminMiddleware::class]),
    Route::get('/admin/posts', [AdminPostsController::class, 'index'], [AdminMiddleware::class]),
    Route::get('/admin/getPosts', [AdminPostsController::class, 'getPosts'], [AdminMiddleware::class]),
    Route::post('/admin/posts/delete/\d+', [AdminPostsController::class, 'deletePost'], [AdminMiddleware::class]),
    Route::get('/admin/changes', [AdminChangesController::class, 'index'], [AdminMiddleware::class]),
    Route::get('/admin/getChanges', [AdminChangesController::class, 'getChanges'], [AdminMiddleware::class]),
];
