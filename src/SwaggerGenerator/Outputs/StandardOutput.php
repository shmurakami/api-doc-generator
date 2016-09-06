<?php
namespace shmurakami\SwaggerGenerator\Outputs;

class StandardOutput implements OutputInterface
{

    public function output($value)
    {
        echo $value;
    }
}