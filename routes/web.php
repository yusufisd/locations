<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Models\Location;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(LocationController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/locations', 'index')->name('locations.index');
    Route::get('/locations/create', 'create')->name('locations.create');
    Route::post('/locations', 'store')->name('locations.store');
    Route::get('/locations/{id}/edit', 'edit')->name('locations.edit');
    Route::put('/locations/{id}', 'update')->name('locations.update');
    Route::delete('/locations/{id}', 'destroy')->name('locations.destroy');
    Route::get('/locations/route/index', 'route')->name('locations.route.index');
});

Route::get('/locations/route', function () {
    $locations = Location::all();
    return response()->json($locations);
})->name('locations.route');
