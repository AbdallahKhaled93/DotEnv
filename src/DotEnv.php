<?php

namespace Dino;

class DotEnv
{
    private $path;

    public function __construct($path)
    {
        if(!is_readable($path))
        {
            throw new \InvalidArgumentException("File not found or not readable");
        }

        $this->path = $path;
    }

    public function load()
    {
        $configs = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        /* Save variables to $_ENV */
        foreach ($configs as $config)
        {
            /* skip comments */
            if (strpos(trim($config), '#') === 0) {
                continue;
            }

            $parts = explode("=", $config);
            $name = trim($parts[0]);
            $value = trim($parts[1]);
            $_ENV[$name] = $value;
        }
    }
}