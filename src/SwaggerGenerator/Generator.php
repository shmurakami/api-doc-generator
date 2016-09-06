<?php
namespace shmurakami\SwaggerGenerator;

use shmurakami\SwaggerGenerator\Generators\GeneratorInterface;
use shmurakami\SwaggerGenerator\Generators\YamlGenerator;
use shmurakami\SwaggerGenerator\Outputs\OutputInterface;
use shmurakami\SwaggerGenerator\Outputs\StandardOutput;

class Builder
{
    /** @var Parser */
    private $parser;

    /** @var GeneratorInterface */
    private $generator;

    /** @var OutputInterface */
    private $output;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function generate($input)
    {
        $parsedValues = $this->getParser()->parse($input);

        // StandardOutput is only supported so far.
        $this->getOutput()->output($this->getGenerator()->generate($parsedValues));
    }

    public function setGenerator(GeneratorInterface $generator)
    {
        $this->generator = $generator;
        return $this;
    }

    /**
     * @return GeneratorInterface
     */
    private function getGenerator()
    {
        if (is_null($this->generator)) {
            return new YamlGenerator();
        }
        return $this->generator;
    }

    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @return OutputInterface
     */
    private function getOutput()
    {
        if (is_null($this->output)) {
            return new StandardOutput();
        }
        return $this->output;
    }

    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * @return Parser
     */
    private function getParser()
    {
        if (is_null($this->parser)) {
            return new Parser();
        }
        return $this->parser;
    }
}
