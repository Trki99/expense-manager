<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
    return view('layout.welcome');
})->name('welcome');

Route::group(['middleware' => 'auth'], function() {
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin'
        
    ], function() {
        Route::get('/users_list', [AdminController::class, 'showUsersList'])->name('admin_users_list');
        Route::get('/add_new_user', [AdminController::class, 'showAddNewUser'])->name('add_new_user');
        Route::post('/create_user', [AdminController::class, 'createNewUser'])->name('admin_create_user');
        Route::post('/update_user', [AdminController::class, 'updateUser'])->name('admin_update_user');
        Route::post('/delete_user', [AdminController::class, 'deleteUser'])->name('admin_delete_user');
        Route::post('/block_user', [AdminController::class, 'blockUser'])->name('admin_block_user');
        Route::post('/unblock_user', [AdminController::class, 'unblockUser'])->name('admin_unblock_user');
    });

    Route::group([], function() {
        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
        Route::post('/update_profile', [ProfileController::class, 'updateUserProfile'])->name('update_profile');

        Route::get('/categories', [CategoryController::class, 'showCategories'])->name('categories');
        Route::get('/add_new_category', [CategoryController::class, 'showAddNewCategory'])->name('add_new_category');
        Route::post('/create_category', [CategoryController::class, 'createCategory'])->name('create_category');
        Route::post('/update_category', [CategoryController::class, 'updateCategory'])->name('update_category');
        Route::post('/delete_category', [CategoryController::class, 'deleteCategory'])->name('delete_category');

        Route::get('/incomes', [IncomeController::class, 'showIncomes'])->name('incomes');
        Route::get('add_new_income', [IncomeController::class, 'showAddNewIncome'])->name('add_new_income');
        Route::post('/create_income', [IncomeController::class, 'createIncome'])->name('create_income');
        Route::post('/update_income', [IncomeController::class, 'updateIncome'])->name('update_income');
        Route::post('/delete_income', [IncomeController::class, 'deleteIncome'])->name('delete_income');

        Route::get('/expenses', [ExpenseController::class, 'showExpenses'])->name('expenses');
        Route::get('/add_new_expense', [ExpenseController::class, 'showAddNewExpense'])->name('add_new_expense');
        Route::post('/create_expense', [ExpenseController::class, 'createExpense'])->name('create_expense');
        Route::post('/update_expense', [ExpenseController::class, 'updateExpense'])->name('update_expense');
        Route::post('/delete_expense', [ExpenseController::class, 'deleteExpense'])->name('delete_expense');

        Route::get('/report', [ReportController::class, 'showReport'])->name('get_report');
        Route::post('/report', [ReportController::class, 'showReport'])->name('post_report');
    });
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); */

require __DIR__.'/auth.php';
