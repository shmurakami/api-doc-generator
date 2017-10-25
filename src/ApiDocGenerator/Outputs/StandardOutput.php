<?php
namespace shmurakami\ApiDocGenerator\Outputs;

class StandardOutput implements OutputInterface
{

    public function output($value)
    {
        echo $value;
    }
}