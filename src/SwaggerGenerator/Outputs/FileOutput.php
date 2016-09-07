<?php
namespace shmurakami\SwaggerGenerator\Outputs;

class FileOutput implements OutputInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function output($value)
    {
        file_put_contents($this->path, $value);
    }
}