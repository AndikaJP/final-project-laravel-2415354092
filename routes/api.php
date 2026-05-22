<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::apiResource('services', ServiceController::class);
Route::patch('services/{service}/activate', [ServiceController::class, 'activate'])->name('services.activate');
Route::patch('services/{service}/deactivate', [ServiceController::class, 'deactivate'])->name('services.deactivate');

Route::apiResource('customers', CustomerController::class);
Route::patch('customers/{customer}/activate', [CustomerController::class, 'activate'])->name('customers.activate');
Route::patch('customers/{customer}/deactivate', [CustomerController::class, 'deactivate'])->name('customers.deactivate');

Route::apiResource('subscriptions', SubscriptionController::class);

Route::get(
    'subscriptions/status/{status}',
    [SubscriptionController::class, 'getByStatus']
)->name('subscriptions.byStatus');

Route::patch(
    'subscriptions/{id}/status',
    [SubscriptionController::class, 'changeStatus']
)->name('subscriptions.changeStatus');