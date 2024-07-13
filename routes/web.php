<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EventController;

// Home route
Route::get('/', function () {
    return view('consultation');
});

// Consultation routes
Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

// Approval routes
Route::get('/approve-disapprove', [ApprovalController::class, 'index'])->name('approve.index');
Route::post('/approve-disapprove/approve/{id}', [ApprovalController::class, 'approve'])->name('approve.approve');
Route::post('/approve-disapprove/disapprove/{id}', [ApprovalController::class, 'disapprove'])->name('approve.disapprove');
Route::post('/approve-disapprove/delete', [ApprovalController::class, 'delete'])->name('approve.delete');

// Calendar routes
Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('/events', [EventController::class, 'store'])->name('events.store');

// Calendar Event route
Route::get('/calendar/event/{id}', 'CalendarController@showEvent')->name('calendar.showEvent');
