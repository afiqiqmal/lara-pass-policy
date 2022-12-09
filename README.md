# Laravel Password Policy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/afiqiqmal/lara-pass-policy.svg?style=flat-square)](https://packagist.org/packages/afiqiqmal/lara-pass-policy)
[![Total Downloads](https://img.shields.io/packagist/dt/afiqiqmal/lara-pass-policy.svg?style=flat-square)](https://packagist.org/packages/afiqiqmal/lara-pass-policy)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/paypalme/mhi9388?locale.x=en_US)

![](https://banners.beyondco.de/LaraPassPolicy.png?theme=dark&packageManager=composer+require&packageName=afiqiqmal%2Flara-pass-policy&pattern=dominos&style=style_1&description=&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

## Installation

You can install the package via composer:

```bash
composer require afiqiqmal/lara-pass-policy
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Afiqiqmal\LaraPassPolicy\LaraPassPolicyServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Afiqiqmal\LaraPassPolicy\LaraPassPolicyServiceProvider" --tag="config"
```

## Usage

#### Add `HasPasswordPolicy` trait to the authenticable model
#### Add `MustVerifyPasswordPolicy` interface to the authenticable model

```php
class User extends Authenticable implements MustVerifyPasswordPolicy
{
     use HasPasswordPolicy;
     ...
     ...
}
```

#### Add Middleware
Add `EnsurePasswordIsChanged` middleware in `$routeMiddleware`
```php
protected $routeMiddleware = [
    ...
    'password_changed' => EnsurePasswordIsChanged::class,
    ...
];

```
so you can attach it to your routes:

```php
// routes/web.php

Route::middleware(['auth', 'password_changed'])->group(function () {
    return view('welcome');
});
```

## Disable in some environment.
If you want to disable Password Policy on specific environment (ex: `local`) set to `false` this variable in `.env` file:

```ini
# Set to false to disable password policy.
PASSWORD_POLICY_ENABLED=false
```

## Validation rules.
If you need to apply your own default password rules, you should define a `defaults` callback within the boot method
of one of your application's service providers, as described in
[Laravel docs](https://laravel.com/docs/master/validation#defining-default-password-rules): this package
will validate new passwords against those defaults.

---

## Credits

- [Hafiq](https://github.com/afiqiqmal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<a href="https://www.paypal.com/paypalme/mhi9388?locale.x=en_US"><img src="https://i.imgur.com/Y2gqr2j.png" height="40"></a>
