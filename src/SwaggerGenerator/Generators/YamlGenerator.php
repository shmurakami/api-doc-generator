<?php
namespace shmurakami\SwaggerGenerator\Generators;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlGenerator
 * @package shmurakami\SwaggerGenerator\Generator
 */
class YamlGenerator implements GeneratorInterface
{

    public function generate($values)
    {
        // depend to symfony\yaml
        return Yaml::dump($values);
    }
}
