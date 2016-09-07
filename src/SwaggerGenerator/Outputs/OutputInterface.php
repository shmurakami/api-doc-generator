<?php
namespace shmurakami\SwaggerGenerator\Outputs;

interface OutputInterface
{
    const TYPE_STANDARD_OUT = 'stdout';
    const TYPE_FILE = 'file';

    public function output($value);

}
