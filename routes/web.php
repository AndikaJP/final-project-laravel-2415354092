<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.customers');

Route::view('/users', 'pages.users');
Route::view('/customers', 'pages.customers');
Route::view('/services', 'pages.services');
Route::view('/subscriptions', 'pages.subscriptions');