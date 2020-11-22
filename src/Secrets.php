<?php

namespace CorBosman\DockerSecrets;

class Secrets
{
    protected $path = '/run/secrets';

    /**
     * @param $secret
     * @return string
     */
    public function get($secret)
    {
        return trim(file_get_contents("{$this->path}/{$secret}"));
    }

    /**
     * @param $secret
     * @return bool
     */
    public function exists($secret)
    {
        return file_exists("{$this->path}/{$secret}");
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
