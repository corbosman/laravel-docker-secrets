<?php

namespace CorBosman\DockerSecrets\Console;

use Illuminate\Console\Command;

class CreateEncryptedPasswordCommand extends Command
{
    protected $signature = 'docker-secret:encrypt {password}';
    protected $description = 'Generate an encrypted Docker Secret string';

    public function handle()
    {
        $this->info(encrypt($this->argument('password')));
    }
}
