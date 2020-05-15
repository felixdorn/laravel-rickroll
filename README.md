# Laravel RickRoll

[![Latest Version on Packagist](https://img.shields.io/packagist/v/felixdorn/laravel-rickroll.svg?style=flat-square)](https://packagist.org/packages/felixdorn/laravel-rickroll)
[![Build Status](https://github.com/felixdorn/laravel-rickroll/workflows/CI/badge.svg?branch=master)](https://github.com/felixdorn/laravel-rickroll)
[![Total Downloads](https://img.shields.io/packagist/dt/felixdorn/laravel-rickroll.svg?style=flat-square)](https://packagist.org/packages/felixdorn/laravel-rickroll)

Redirects people trying to break your site to Never Gonna Give You Up, from Rick Astley. This package is 100% inspired by [Liam Hammett's tweet](https://twitter.com/LiamHammett/status/1260984553570570240).


## Installation
You can install the package via composer:

```bash
composer require felixdorn/laravel-rickroll
```

## Usage
On your `routes/web.php` just add this single line, and we'll handle the rest for you!

```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes();
```

### Redirecting to custom urls
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes()->clear();
```

## Events
We're dispatching an event with the current request when someone is rick-rolled.
Just listen for `Felix\RickRoll\RickRolled` in your `EventServiceProvider` .

### Testing
``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hi@felixdorn.fr instead of using the issue tracker.

## Credits

- [Félix Dorn](https://github.com/felixdorn)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
