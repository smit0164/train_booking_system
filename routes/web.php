<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\stationinfoController;
use App\Http\Controllers\admin\RouteController;
use App\Http\Controllers\admin\TrainController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserDashboardController ;

Route::get('/',[UserDashboardController::class,'index'])->name('user.dashboard')->middleware('auth:user');

Route::get('register',[UserAuthController::class,'showRegisterForm'])->name('user.register')->middleware('guest:user');
Route::post('register',[UserAuthController::class,'register'])->middleware('guest:user');
Route::get('login',[UserAuthController::class,'showLoginForm'])->name('user.login')->middleware('guest:user');
Route::post('login',[UserAuthController::class,'login'])->middleware('guest:user');
Route::post('logout',[UserAuthController::class,'logout'])->name('user.logout')->middleware('auth:user');


Route::get('admin/login',[AdminAuthController::class,'showLoginForm'])->name('admin.login')->middleware('guest:admin');
Route::post('admin/login',[AdminAuthController::class,'login'])->middleware('guest:admin');
Route::post('admin/logout',[AdminAuthController::class,'logout'])->name('admin.logout')->middleware('auth:admin');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');
Route::get('admin/stationinfo', [stationinfoController::class, 'index'])->name('admin.station_info.index')->middleware('auth:admin');
Route::get('admin/create_station_info',[stationinfoController::class, 'create'])->name('admin.station_info.create')->middleware('auth:admin');
Route::post('admin/store_station_info',[stationinfoController::class, 'store'])->name('admin.station_info.store')->middleware('auth:admin');
Route::delete('admin/delete_station_info/{id}',[stationinfoController::class, 'destroy'])->name('admin.station_info.destroy')->middleware('auth:admin');
Route::get('admin/edit_station_info/{id}',[stationinfoController::class, 'edit'])->name('admin.station_info.edit')->middleware('auth:admin');
Route::put('admin/update_station_info/{id}',[stationinfoController::class, 'update'])->name('admin.station_info.update')->middleware('auth:admin');

Route::get('admin/route_info',[RouteController::class,'index'])->name('admin.route_info.index')->middleware('auth:admin');
Route::get('admin/create_route_info',[RouteController::class,'create'])->name('admin.route_info.create')->middleware('auth:admin');
Route::post('admin/store_route_info',[RouteController::class,'store'])->name('admin.route_info.store')->middleware('auth:admin');
Route::delete('admin/delete_route_info/{routeinfo}',[RouteController::class,'destroy'])->name('admin.route_info.destroy')->middleware('auth:admin');
Route::get('admin/edit_route_info/{routeinfo}',[RouteController::class,'edit'])->name('admin.route_info.edit')->middleware('auth:admin');
Route::put('admin/update_route_info/{routeinfo}',[RouteController::class,'update'])->name('admin.route_info.update')->middleware('auth:admin');

Route::get('admin/train_info',[TrainController::class,'index'])->name('admin.train_info.index')->middleware('auth:admin');
Route::get('admin/create_train_info',[TrainController::class,'create'])->name('admin.train_info.create')->middleware('auth:admin');
Route::post('admin/store_train_info',[TrainController::class,'store'])->name('admin.train_info.store')->middleware('auth:admin');
Route::delete('admin/delete_train_info/{trainInfo}',[TrainController::class,'destroy'])->name('admin.train_info.destroy')->middleware('auth:admin');
Route::get('admin/edit_train_info/{trainInfo}',[TrainController::class,'edit'])->name('admin.train_info.edit')->middleware('auth:admin');
Route::put('admin/update_train_info/{trainInfo}',[TrainController::class,'update'])->name('admin.train_info.update')->middleware('auth:admin');