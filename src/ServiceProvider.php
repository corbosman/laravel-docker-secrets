<?php

namespace CorBosman\DockerSecrets;

use CorBosman\DockerSecrets\Console\CreateEncryptedPasswordCommand;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot(Decrypter $decrypter): void
    {
        if (!$this->app->configurationIsCached()) {
            $decrypter->decryptSecrets();
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateEncryptedPasswordCommand::class,
            ]);
        }
    }

    public function provides()
    {
        return ['laravel-docker-secrets'];
    }
}
