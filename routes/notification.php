<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    // Notification
    Route::get('/list_notification', [NotificationController::class, 'index'])->name('allNotification');
    Route::post('/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsread'); //mar read single notification
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead'); // mark as read all
    Route::get('/view_notification/{id}', [NotificationController::class, 'viewNotification'])->name('viewSingleNotification');
});
