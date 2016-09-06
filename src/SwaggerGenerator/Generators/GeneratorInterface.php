<?php
namespace shmurakami\SwaggerGenerator\Generators;

interface GeneratorInterface
{
    const TYPE_YAML = 'yaml';
    const TYPE_JSON = 'json';

    public function generate($values);

}