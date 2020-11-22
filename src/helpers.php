<?php

use CorBosman\DockerSecrets\Secrets;
use CorBosman\DockerSecrets\Decrypter;

if (! function_exists('docker_secret')) {
    function docker_secret($secret, $default = null)
    {
        return function () use ($secret, $default) {
            $secrets = resolve(Secrets::class);
            return $secrets->exists($secret) ? $secrets->get($secret) : $default;
        };
    }
}

if (! function_exists('docker_secret_encrypted')) {
    function docker_secret_encrypted($secret, $default = null)
    {
        return function () use ($secret, $default) {
            $secrets = resolve(Secrets::class);
            return $secrets->exists($secret) ? Decrypter::PREFIX . $secrets->get($secret) : $default;
        };
    }
}
