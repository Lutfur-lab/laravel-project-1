<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Publicly accessible routes for viewing books
Route::get('/books', [BookController::class, 'index'])->name('books.index'); // List all books
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show'); // Display a single book

// Route for dashboard as the default homepage
Route::get('/', [BookController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard');

// Publicly accessible route for viewing comments on a book
Route::get('/books/{bookId}/comments', [CommentController::class, 'index'])->name('comments.index'); // List all comments for a specific book

// Routes for user management, only accessible to authenticated users with the 'manage-users' permission
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/Users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
});

// Routes for book management, only accessible to authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/createbook', [BookController::class, 'create'])->name('books.create'); // Show form to create a new book
    Route::post('/books', [BookController::class, 'store'])->name('books.store'); // Store new book
    Route::get('/categories/{id}/books', [CategoryController::class, 'showBooks'])->name('categories.books'); // Show books in a category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); // List all categories
    Route::post('/books/{bookId}/comments', [CommentController::class, 'store'])->name('comments.store'); // Store a new comment on a book
    Route::get('/books/{bookId}/writecomments', [CommentController::class, 'show'])->name('comments.show'); // Show the form to write a comment
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy'); // Delete a book
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit'); // Show the form to edit a book
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update'); // Update a book
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('can:delete-comment'); // Delete a comment
});

// Routes for registration and authentication
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


// Protected profile management, only accessible to authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Authenticated users will be redirected to /books after login or registration
Route::get('/dashboard', function () {
    return redirect()->route('books.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// Protected profile management, only accessible to authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include additional authentication routes (e.g., login, logout)
require __DIR__.'/auth.php';
