<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\stationinfoController;
use App\Http\Controllers\admin\RouteController;
use App\Http\Controllers\admin\TrainController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('admin/stationinfo', [stationinfoController::class, 'index'])->name('admin.station_info.index');
Route::get('admin/create_station_info',[stationinfoController::class, 'create'])->name('admin.station_info.create');
Route::post('admin/store_station_info',[stationinfoController::class, 'store'])->name('admin.station_info.store');
Route::delete('admin/delete_station_info/{id}',[stationinfoController::class, 'destroy'])->name('admin.station_info.destroy');
Route::get('admin/edit_station_info/{id}',[stationinfoController::class, 'edit'])->name('admin.station_info.edit');
Route::put('admin/update_station_info/{id}',[stationinfoController::class, 'update'])->name('admin.station_info.update');

Route::get('admin/route_info',[RouteController::class,'index'])->name('admin.route_info.index');
Route::get('admin/create_route_info',[RouteController::class,'create'])->name('admin.route_info.create');
Route::post('admin/store_route_info',[RouteController::class,'store'])->name('admin.route_info.store');
Route::delete('admin/delete_route_info/{routeinfo}',[RouteController::class,'destroy'])->name('admin.route_info.destroy');
Route::get('admin/edit_route_info/{routeinfo}',[RouteController::class,'edit'])->name('admin.route_info.edit');
Route::put('admin/update_route_info/{routeinfo}',[RouteController::class,'update'])->name('admin.route_info.update');

Route::get('admin/train_info',[TrainController::class,'index'])->name('admin.train_info.index');
Route::get('admin/create_train_info',[TrainController::class,'create'])->name('admin.train_info.create');
Route::post('admin/store_train_info',[TrainController::class,'store'])->name('admin.train_info.store');
Route::delete('admin/delete_train_info/{trainInfo}',[TrainController::class,'destroy'])->name('admin.train_info.destroy');
Route::get('admin/edit_train_info/{trainInfo}',[TrainController::class,'edit'])->name('admin.train_info.edit');
Route::put('admin/update_train_info/{trainInfo}',[TrainController::class,'update'])->name('admin.train_info.update');