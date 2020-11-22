<?php

namespace CorBosman\DockerSecrets\Tests\Unit;

use Orchestra\Testbench\TestCase;
use CorBosman\DockerSecrets\Secrets;

class SecretsTest extends TestCase
{
    protected $secrets;

    public function setUp() : void
    {
        parent::Setup();

        $this->secrets = resolve(Secrets::class)->setPath(__DIR__ . '/../secrets');
    }

    public function test_it_can_read_a_secret()
    {
        $this->assertEquals('mysecretvalue', $this->secrets->get('my-secret'));
    }

    public function test_it_gives_an_exception_if_you_try_to_read_a_secret_that_does_not_exist()
    {
        $this->expectException(\ErrorException::class);
        $this->assertEquals('mysecretvalue', $this->secrets->get('othersecret'));
    }

    public function test_it_can_check_if_a_secret_exists()
    {
        $this->assertTrue($this->secrets->exists('my-secret'));
    }

    public function test_it_returns_false_if_a_secret_does_not_exist()
    {
        $this->assertFalse($this->secrets->exists('othersecret'));
    }

}
