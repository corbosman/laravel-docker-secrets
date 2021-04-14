# Laravel Docker Secrets

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
![Build](https://github.com/corbosman/laravel-docker-secrets/workflows/build/badge.svg?branch=main)

This package allows you to use docker swarm secrets in your Laravel config files. Note there are some limitations, see the usage below.

## Installation

Via Composer

``` bash
$ composer require corbosman/laravel-docker-secrets
```

## Usage

This package provides two helper methods that you can use in your laravel config files. Due to the way Laravel parses the config files, you can only use them in the env() method. In practice this is almost always exactly what you want, as it allows you to override the secrets locally for development.  

```php
<?php
    return [
        'password' => env('PASSWORD', docker_secret('my-docker-secret'))
    ];
?>   
```

You can also store encrypted docker secrets. Note that the secret must be encrypted using your app's key. This is useful if you share your swarm with a team. Other projects can't just mount your secrets and view them. 

```php
<?php
    return [
        'password' => env('PASSWORD', docker_secret_encrypted('my-encrypted-docker-secret'))
    ];
?>   
```

Finally, you can also return a default value if the secret isn't available.

```php
<?php
    return [
        'password' => env('PASSWORD', docker_secret_encrypted('my-docker-secret', 'my-default'))
    ];
?>      
```

## Creating encrypted secret

This package offers a command to easily generate an encrypted secret which you can then store in Docker Swarm. It uses the project's app secret for encryption so make sure that this same key is also used in the service that uses the Swarm secret. You can also simply use Tinker to create encrypted secrets. 

```bash
$ artisan docker-secret:encrypt foobar
eyJpdiI6ImY5dWdHeHJ2WkpZdUNTZFlVYUZpMFE9PSIsInZhbHVlIjoidmZPblk2eEIxNy8vdkl6OE5YSGF2dz09IiwibWFjIjoiZTdmYmVmNmQ5YzA5ZTI3YzI0NjFjOGJkOTY5ODhjNDkwMmMwYWVmMTkwYzcyNzMzN2ZlYWQ1NzlhNzlkM2RjZCJ9
```



## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [Cor Bosman][link-author]

## License

Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/corbosman/laravel-docker-secrets.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/corbosman/laravel-docker-secrets.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/corbosman/laravel-docker-secrets
[link-downloads]: https://packagist.org/packages/corbosman/laravel-docker-secrets
[link-author]: https://github.com/corbosman
