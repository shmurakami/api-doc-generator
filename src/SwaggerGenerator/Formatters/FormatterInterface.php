<?php
namespace shmurakami\SwaggerGenerator\Formatters;

interface FormatterInterface
{
    const TYPE_YAML = 'yaml';
    const TYPE_JSON = 'json';

    public function generate($values);

}