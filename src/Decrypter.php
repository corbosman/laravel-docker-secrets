<?php

namespace CorBosman\DockerSecrets;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Decrypter
{
    const PREFIX = '__encrypted__:';

    public function decryptSecrets()
    {
        collect(Arr::dot(config()->all()))->filter(function ($config) {
            return is_string($config) && Str::startsWith($config, static::PREFIX);
        })->map(function ($secret, $key) {
            config()->set($key, decrypt(Str::replaceFirst(static::PREFIX, '', $secret)));
        });
    }
}
