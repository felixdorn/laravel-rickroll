<p align="center">
    <a href="https://github.com/felixdorn/laravel-rickrollf">
        <img src="https://res.cloudinary.com/dy3jxhiba/image/upload/v1589534220/Screenshot_from_2020-05-15_11-12-52_1_hlj5aj.png" width="150" alt="">
    </a>
    <h1 align="center">
        Laravel RickRoll
    </h1>
    <p align="center">
        <img src="https://github.com/felixdorn/laravel-rickroll/workflows/CI/badge.svg?branch=master" alt="CI" />
       <img src="https://github.styleci.io/repos/264041666/shield?branch=master&style=flat" alt="StyleCI">
        <img src="https://img.shields.io/packagist/l/felixdorn/laravel-rickroll" alt="License" />
        <img src="https://img.shields.io/packagist/v/felixdorn/laravel-rickroll" alt="Last Version" />
    </p>
</p>

Redirects people trying to break your site to Never Gonna Give You Up, from Rick Astley. This package is inspired by [Liam Hammett's tweet](https://twitter.com/LiamHammett/status/1260984553570570240).


## Getting started
You can install the package via composer, if you don't have composer, di:

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


## Usage
On your `routes/web.php` just add this single line, and we'll handle the rest for you!

```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes();
```

### Redirecting to custom urls
```php
use Felix\Rickroll\Facades\RickRoll;

RickRoll::routes()->redirectsTo('https://mycustom.url');
```

### Remove url
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
rickroll($dispatchEvent = true, 'https://my-custom.url');
```
You don't need to return anything, it works just like a `abort`.


### Events
We're dispatching an event with the current request when someone is rick-rolled.
Just listen for `Felix\RickRoll\Events\RickRolled` in your `EventServiceProvider` .

## We need your knowledge!
Do you know any well-known url that "hackers" tries to break a site ?
Add these [here](src/LaravelRickRoll.php) in the $urls array, and submit a PR, thanks! 

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
