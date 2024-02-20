<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\PhotosController as AdminPhotosController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\CommentsController as AdminCommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

//Photos
Route::get('/photos', [PhotosController::class, 'index'])->name('photos');
Route::get('/photos/{id}', [PhotosController::class, 'show'])->name('photos.show');
Route::post('/photos/upload', [PhotosController::class, 'store'])->name('photos.store');
Route::get('/photos/upload', [PhotosController::class, 'create'])->name('photos.upload');
Route::delete('/photos/{photo}', [PhotosController::class, 'destroy'])->name('photos.destroy')->middleware('auth');

//Users
Route::get('/users', [UsersController::class, 'index'])->name('users');

//Contacts
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');

//Auth
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [LoginController::class, 'login'])->name('user.login.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

//Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');


//Comments
Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store')->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication Routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Admin Registration Routes
    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AdminRegisterController::class, 'register'])->name('register.submit');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // Admin Photos Management
        Route::get('/photos', [AdminPhotosController::class, 'index'])->name('photos.index');
        Route::get('/photos/create', [AdminPhotosController::class, 'create'])->name('photos.create');
        Route::post('/photos', [AdminPhotosController::class, 'store'])->name('photos.store');
        Route::get('/photos/{photo}/edit', [AdminPhotosController::class, 'edit'])->name('photos.edit');
        Route::put('/photos/{photo}', [AdminPhotosController::class, 'update'])->name('photos.update');
        Route::delete('/photos/{photo}', [AdminPhotosController::class, 'destroy'])->name('photos.destroy');
        Route::get('/photos/{photo}/comments', [AdminPhotosController::class, 'showComments'])->name('photos.comments');

       // Admin Users Management
        Route::get('/users', [AdminUsersController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUsersController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUsersController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{user}/photos', [AdminUsersController::class, 'showPhotos'])->name('users.photos');
    });
});

Route::delete('admin/comments/{comment}', [AdminCommentsController::class, 'destroy'])->name('admin.comments.destroy');
