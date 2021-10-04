<?php

use Afiqiqmal\LaraPassPolicy\Controllers\PasswordExpiredChangeController;

Route::group(['prefix' => config('lara-pass-policy.prefix', ''),'middleware' => config('lara-pass-policy.middleware', ['web'])], function () {
    if (config('lara-pass-policy.enabled')) {
        Route::get('password/revalidation', [PasswordExpiredChangeController::class, 'index'])
            ->middleware(['auth:' . config('lara-pass-policy.guard')])
            ->name('password_change.notice');

        Route::post('password/revalidation', [PasswordExpiredChangeController::class, 'store'])
            ->middleware(['auth:' . config('lara-pass-policy.guard')])
            ->name('password_change.send');
    }
});
