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
    | is expired and need to change the password.
    |
    */

    'password_lifetime' => env('PASSWORD_LIFETIME', 30), // days

    'reminder_password_to_change' => [
        1, // last 1 day
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
    | The PasswordHistory model class.
    |
    */

    'model' => \Afiqiqmal\LaraPassPolicy\Models\PasswordHistory::class,

    /*
    |--------------------------------------------------------------------------
    | Password Policy Observer
    |--------------------------------------------------------------------------
    |
    | The observer class watching on User model changes.
    |
    */

    'observer' => \Afiqiqmal\LaraPassPolicy\Observers\PasswordPolicyObserver::class,

    /*
    |--------------------------------------------------------------------------
    | Password Policy Redirection
    |--------------------------------------------------------------------------
    |
    | This configuration is used to
    |
    */

    'redirects' => [
        'password-changed' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Policy View
    |--------------------------------------------------------------------------
    |
    | This view will be used by the user to change its own password when expired.
    | If you want to integrate Inertia, here you have to specify the page you
    | created in `resource/js/Page folder` (see https://inertiajs.com/pages).
    |
    | Examples:
    |   - standard stack (Blade templates):
    |     'views' => [
    |         'password-changed' => 'auth.verify_password_change',
    |     ],
    |
    |   - Inertia stack (Vue/React/Svelte templates):
    |     'views' => [
    |         'password-changed' => 'Auth/VerifyPasswordChange',
    |     ],
    */

    'views' => [
        'password-changed' => 'auth.verify-password-change'
    ],

    'messages' => [
        'same-password' => 'Your password cannot be same as previous password',
        'expired' => 'Your password is expired. Please change it first'
    ],
];
