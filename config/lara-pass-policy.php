<?php

return [

    /*
   |--------------------------------------------------------------------------
   | Pass policy enabled
   |--------------------------------------------------------------------------
   |
   | This configuration is used to enable the password policy,
   | if set to false, the middleware will be bypassed
   |
   */

    'enabled' => env('PASSWORD_POLICY_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Pass policy Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify which authentication guard Pass policy will use while
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'cms',

    /*
   |--------------------------------------------------------------------------
   | Pass policy Routes Middleware
   |--------------------------------------------------------------------------
   |
   | Here you may specify which middleware Pass policy will assign to the routes
   | that it registers with the application. If necessary, you may change
   | these middleware but typically this provided default is preferred.
   |
   */

    'middleware' => ['cms'],

    'prefix' => 'cms',

    /*
   |--------------------------------------------------------------------------
   | Password period
   |--------------------------------------------------------------------------
   |
   | This configuration is used to notify user if the password used
   | is expired and need to change the password
   |
   */

    'password_lifetime' => 60, //days

    'reminder_password_to_change' => [
        1, // last 1 days
        5, // last 5 days
        10, // last 10 days
        15, // last 15 days
    ], // not set will set to last 1 day

    /*
   |--------------------------------------------------------------------------
   | Password history depth check
   |--------------------------------------------------------------------------
   |
   | This configuration is used to check n previous password histories
   | against when changing/resetting a password
   |
   */

    'depth' => 6,

    /*
    |--------------------------------------------------------------------------
    | Password History Table Configurations
    |--------------------------------------------------------------------------
    |
    | This configuration is used to
    |
    */

    'model' => \Afiqiqmal\LaraPassPolicy\Models\PasswordHistory::class,

    /*
    |--------------------------------------------------------------------------
    | Password Policy Observer
    |--------------------------------------------------------------------------
    |
    | This configuration is used to
    |
    */

    'observer' => \Afiqiqmal\LaraPassPolicy\Observers\PasswordPolicyObserver::class,

    /*
    |--------------------------------------------------------------------------
    | Password Policy Strict
    |--------------------------------------------------------------------------
    |
    | This configuration is used to
    |
    */

    'strict' => \Illuminate\Validation\Rules\Password::min(8)
        ->mixedCase()
        ->numbers()
        ->symbols()
        ->uncompromised(),

    /*
   |--------------------------------------------------------------------------
   | Password Policy Redirection and Views
   |--------------------------------------------------------------------------
   |
   | This configuration is used to
   |
   */

    'redirects' => [
        'password-changed' => null,
    ],

    'views' => [
        'password-changed' => 'auth.verify-password-change'
    ],

    'messages' => [
        'same-password' => 'Your password cannot be same as previous password',
        'expired' => 'Your password is expired. Please change it first'
    ],
];
