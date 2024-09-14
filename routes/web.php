<?php
use App\Http\Controllers\JobBoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('users', UserController::class);
Route::get('/admin/usermanagement', [UserController::class, 'index'])->name('admin.usermanagement');

Auth::routes();

Route::resource("posts", PostController::class);
Route::post('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/search', [PostController::class, 'filter'])->name('posts.filter');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource("posts", PostController::class);

Route::resource("comments", CommentController::class);
Route::resource("posts", PostController::class);

Route::post('/search', [PostController::class, 'search'])->name('posts.search');



Route::get('/home', [App\Http\Controllers\JobBoardController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:employer,admin'])->group(function () {
    Route::resource('posts', PostController::class);
});

Route::get('/posts/showOnePost/{id}', [PostController::class, 'showForEveryOne'])->name('posts.showForEveryOne');
Route::post('/search', [PostController::class, 'search'])->name('posts.search');


Route::resource('applications', (ApplicationController::class));
Route::get('/indexEmployerApp/{post_id?}', [ApplicationController::class, 'indexEmployerApp'])->name('applications.indexEmployerApp');
Route::get('/create/application/{post_id?}', action: [ApplicationController::class, 'createApp'])->name('applications.createApp');

// applications acceptence and rejection routes
Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
// jobboard.show
// Route::get('/posts/{id}', [JobBoardController::class, 'show'])->name('jobboard.show');
// Route::resource("posts", PostController::class);

// downloadResmume
Route::get('/downloadResume', [ApplicationController::class, 'downloadResume'])->name('downloadResume');
Route::resource('applications', (ApplicationController::class));
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('applications/{application}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
// Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin/pending-posts', [AdminController::class, 'pendingPosts'])->name('admin.pending-posts');
    Route::post('/admin/posts/{id}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
    Route::post('/admin/posts/{id}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
});


