<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Category;
use App\Models\Role;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Personal access client created successfully.
Client ID: 7
Client secret: FtBV22Yp6ZQJY53Sxera707zadb1AX5r5nMrWP1F
Password grant client created successfully.
Client ID: 8
Client secret: eifsiMM6oXtiIbHDK5Q9q3QJwQqCO1AJojO4wZv9
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->controller(UserController::class)->group(function () {
    Route::get('', 'getAll');
    Route::middleware('validate.id')->get('{id}', 'getById');
    Route::post('', 'create');
    Route::middleware('validate.id')->delete('{id}', 'delete');
    Route::middleware('validate.id')->put('{id}', 'update');
});

Route::prefix('/profiles')->controller(ProfileController::class)->group(function () {
    Route::get('', 'getAll');
    Route::middleware('validate.id')->get('{id}', 'getById');
    Route::post('', 'create');
    Route::middleware('validate.id')->delete('{id}', 'delete');
    Route::middleware('validate.id')->put('{id}', 'update');
});

Route::prefix('/posts')->controller(PostController::class)->group(function () {
    Route::get('', 'getAll');
    Route::middleware('validate.id')->get('{id}', 'getById');
    Route::post('', 'create');
    Route::middleware('validate.id')->delete('{id}', 'delete');
    Route::middleware('validate.id')->put('{id}', 'update');
});

Route::prefix('/categories')->controller(CategoryController::class)->group(function () {
    Route::get('', 'getAll');
    Route::middleware('validate.id')->get('{id}', 'getById');
    Route::post('', 'create');
    Route::middleware('validate.id')->delete('{id}', 'delete');
    Route::middleware('validate.id')->put('{id}', 'update');
});

Route::prefix('/roles')->controller(Rolecontroller::class)->group(function () {
    Route::get('', 'getAll');
    Route::middleware('validate.id')->get('{id}', 'getById');
    Route::post('', 'create');
    Route::middleware('validate.id')->delete('{id}', 'delete');
    Route::middleware('validate.id')->put('{id}', 'update');
});


// Relación 1:1

Route::get("/user/{id}/profile/", function($id) {
    return User::find($id)->profile;
});

// Relación 1:1 (inversa)

Route::get("/profile/{id}/user/", function($id) {
    return Profile::find($id)->user;
});

// Relación 1:N

Route::get("/posts/{id}", function($id) {
    $posts = Category::find($id)->posts;
    foreach ($posts as $post) {
        echo $post . "<br>";
    }
});

// Relación 1:N (inversa)

Route::get("/post/{id}/user/", function($id) {
    return Post::find($id)->user;
});

Route::get("/post/{id}/categoty/", function($id) {
    return Post::find($id)->category;
});

// Relación N:N

Route::get("/user/{id}/role", function($id) {
    $users = User::find($id);
    foreach ($users->roles as $role) {
        echo $role . " " . $users . "<br>";
    }
});

Route::get("/role/{id}/user", function($id) {
    $roles = Role::find($id);
    foreach ($roles->users as $user) {
        echo $user . " " . $roles . "<br>";
    }
});

// Rutas para el login

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('validate.login')->get('/me', [Logincontroller::class, 'whoAmI']);

// Rutas Passport

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout/{id}', 'logout');
});

Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::middleware('validate.token')->get('user', 'user');
});