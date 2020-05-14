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
On your `routes/web.php` just add this single line and we'll handle the reset for you!
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes();
```

### Changing the video url
If you want to redirect anywhere else on the web, you can do that too !
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes([
    'redirects_to' => 'https://mycustom.url'
]);
```

### Adding custom urls
We support every path that Laravel Router supports.
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes([
    'urls' => [
        '/will/rickroll'
    ]
]);
```

#### Using Regualar Expression Constraints
You may contrain the format of your parameters using the `register` method.
> NOTE: The url is not added to the list of urls but directly registered through the router.

```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::register('/components/page-example-{id}', [
    'id' => '[1-9]+'
]);
```

### Remove defaults urls
If you only want custom urls, this is what you're looking for.
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes([
    'use_defaults' => false
]);
```

### Push an url
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::push('my-custom-url');
```

### Remove an url
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::remove('my-custom-url');
``` 

### List redirected urls
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::all();
// returns an array with ['.env', ...]
```

## Events
We're dispatching an event with the current request when someone is rick-rolled.
Just listen for `Felix\RickRoll\RickRolled` in your `EventServiceProvider` .

### Testing
``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hi@felixdorn.fr instead of using the issue tracker.

## Credits

- [Félix Dorn](https://github.com/felixdorn)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
