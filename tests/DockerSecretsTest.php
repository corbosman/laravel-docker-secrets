<?php

namespace CorBosman\DockerSecrets\Tests;

use CorBosman\DockerSecrets\Secrets;
use CorBosman\DockerSecrets\ServiceProvider;
use Illuminate\Encryption\Encrypter;
use Orchestra\Testbench\TestCase;

class DockerSecretsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        /* set up laravel's decrypter with the key used for the stub secrets */
        app()->bind('encrypter', function() {
            return new Encrypter(base64_decode('gB4PiRxfvBcZAPcb+gVtcqrQQlQ2klUDMbpBJ/dLNlM='), 'AES-256-CBC');
        });

        /* make sure we have the right path to the test secrets */
        app()->bind(Secrets::class, function () {
            return (new Secrets)->setPath(__DIR__ . '/secrets');
        });

        /* add a config with a docker secret */
        $app['config']->set('my-config', env('TEST', docker_secret('my-secret')));

        /* and an encrypted one */
        $app['config']->set('my-encrypted-config', env('TEST', docker_secret_encrypted('my-encrypted-secret')));

        /* and one that does not exist, returning a default value */
        $app['config']->set('my-default-config', env('TEST', docker_secret('some-secret-that-does-not-exist', 'default')));

    }

    public function test_it_can_set_fetch_a_secret_with_the_helper_function()
    {
        $this->assertEquals('mysecretvalue', config()->get('my-config'));
    }

    public function test_the_helper_function_can_return_a_default_value()
    {
        $this->assertEquals('default', config()->get('my-default-config'));
    }

    public function test_the_secret_can_be_encrypted()
    {
        $this->assertEquals('myencryptedsecretvalue', config()->get('my-encrypted-config'));
    }
}
