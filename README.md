<p align="center">
    <a href="https://github.com/felixdorn/laravel-rickrollf">
        <img src="https://res.cloudinary.com/dy3jxhiba/image/upload/v1589534220/Screenshot_from_2020-05-15_11-12-52_1_hlj5aj.png" width="150" alt="">
    </a>
    <h1 align="center">
        Laravel RickRoll
    </h1>
    <p align="center">
        <img src="https://github.com/felixdorn/laravel-rickroll/workflows/CI/badge.svg?branch=master" alt="CI" />
        <img src="https://img.shields.io/packagist/l/felixdorn/laravel-rickroll" alt="License" />
        <img src="https://img.shields.io/packagist/v/felixdorn/laravel-rickroll" alt="Last Version" />
    </p>
</p>

Rickrolls people trying to break your site. This package is inspired by [Liam Hammett's tweet](https://twitter.com/LiamHammett/status/1260984553570570240).


## Getting started
You can install the package via composer, if you don't have composer installed, you can download it [here](https://getcomposer.org):

```bash
composer require felixdorn/laravel-rickroll
```
Or by adding a requirement in your `composer.json` :
```json
{
    "require": {
        "felixdorn/laravel-rickroll": "dev-master"
    }
}
```


## We need your knowledge!
Do you know any well-known url that "hackers" try to break a site ?
Add these [here](src/LaravelRickRoll.php) in the $urls array, thanks! 


## Usage
On your `routes/web.php` just add this single line, and we'll handle the rest for you!

```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes();
```

### Redirecting to a custom URL
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes()->redirectsTo('https://mycustom.url');
```

### Remove all URLs
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes()->clear();
```

### Adding a URL
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes()->push('/rickroll')
    ->push('/rickroll/{id}', [
        'id' => '[0-9]+'
    ]);
```

### Helper
There is a `rickroll` function available if you want to rickroll someone in one of your controllers.

```php
rickroll('https://my-custom.url');
```
You don't need to return anything, it works just like an `abort`.


### Events
We're dispatching an event with the current request when someone is rick-rolled.
Just listen for `Felix\RickRoll\Events\RickRolled` in your `EventServiceProvider` .

## Testing
``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email hi@felixdorn.fr instead of using the issue tracker.

## Credits

- [Félix Dorn](https://github.com/felixdorn)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
