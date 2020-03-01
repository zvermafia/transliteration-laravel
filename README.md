
# Uzbek transliterator for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Integration of the [zvermafia/transliteration](https://github.com/zvermafia/transliteration) with Laravel.

### Navigation by sections
- <a href="#install">Install</a>
- <a href="#setup">Setup</a>
- <a href="#usage">Usage</a>
- <a href="#change-log">Change log</a>
- <a href="#contributing">Contributing</a>
- <a href="#security">Security</a>
- <a href="#credits">Credits</a>
- <a href="#license">License</a>

## Install

Via Composer

``` bash
$ composer require zvermafia/transliteration-laravel
```

## Setup

There are two options for your choice, `alif` and `lotin`. With the option `alif` will be used the [alif.uz](http://alif.uz)'s API. And with the option `lotin` will be used the [lotin.uz](https://lotin.uz)'s API.  
Default option is `alif`. But if you want to change this to the `lotin` option then you simply need to add a `TRANSLITERATOR` key with the value `lotin` into the .env file.
```
TRANSLITERATOR=lotin
```

But if you want to extend this package with your own realization then you need to publish package's configuration file and update it with your option.

To publish the configuration file simply execute the `php artisan vendor:publish` command in the project root folder and select the `Zvermafia\TransliterationLaravel\TransliteratorServiceProvider` as a provider.

## Usage

You can use a `LaraTransliterator` facade but I'll show you another way in the example below.
Let's assume we have a **PoorWorkerController** with a **translit** method in which we want transliterate a requested text (with POST method) and return the result as JSON.

``` php
<?php

namespace App\Http\Controllers;

// use LaraTransliterator; // but we won't use the facade in this example
use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;

class PoorWorkerController
{
    public function translit(Request $request, TransliteratorInterface $transliterator)
    {
        $result = $transliterator->setText($request->input('text'))
            ->toCyrillic()
            ->translit()
            ->getResult();

        return response()->json(compact('result'));
    }
}
```

For AJAX requests you can use a ready-made controller! Firstly you must define a route for the controller:
``` php
// in your routes file
Route::post('translit', '\Zvermafia\TransliterationLaravel\Controllers\TransliteratorController');
```

For AJAX request demonstration we'll use [jQuery](http://jquery.com/) library:
``` js
$.ajax({
    url: '/translit',
    type: 'POST',
    data: {
        // _token: $('meta[name="csrf-token"]').attr('content'),
        text: 'Salom, dunyo!',
        to_cyrillic: 1
    },
    dataType: 'JSON'
})
.done(function (response) {
    if (response.code === 200) {
        alert(response.result);
    } else {
        alert('Something went wrong... Check the console for logs, please.');
        console.log(response);
    }
})
.fail(function (response) {
    console.log('Whoops, something went wrong... Check the response below:');
    console.log(response);
});
```

```js
// A response will be like below:
{
    "code": 200,
    "text": "Salom, dunyo!",
    "to_cyrillic": 1,
    "result": "Салом, дунё!"
} 

// Or if an error occurs the response code will be different from 200
// and response will be like below:
{
    "code": 200,
    "message": "Transliterated text",
} 
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CODE_OF_CONDUCT](.github/CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mohirjon@gmail.com instead of using the issue tracker.

## Credits

- [Mokhirjon Naimov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zvermafia/transliteration-laravel.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zvermafia/transliteration-laravel.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/zvermafia/transliteration-laravel
[link-downloads]: https://packagist.org/packages/zvermafia/transliteration-laravel
[link-author]: https://github.com/zvermafia
[link-contributors]: ../../contributors
