<?php

namespace CorBosman\DockerSecrets;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot(Decrypter $decrypter): void
    {
        if (!app()->configurationIsCached()) {
            $decrypter->decryptSecrets();
        }
    }

    public function provides()
    {
        return ['laravel-docker-secrets'];
    }
}
