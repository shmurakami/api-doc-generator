<?php
namespace shmurakami\ApiDocGenerator;

use shmurakami\ApiDocGenerator\Formatters\FormatterInterface;
use shmurakami\ApiDocGenerator\Formatters\JsonFormatter;
use shmurakami\ApiDocGenerator\Formatters\YamlFormatter;
use shmurakami\ApiDocGenerator\Outputs\OutputInterface;
use shmurakami\ApiDocGenerator\Outputs\StandardOutput;
use shmurakami\ApiDocGenerator\Parsers\ParserInterface;
use shmurakami\ApiDocGenerator\Parsers\SwaggerParser;

class ApiDocGenerator
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var FormatterInterface
     */
    private $format;

    /**
     * @var OutputInterface
     */
    private $output;

    public function generate($input)
    {
        $parsedValues = $this->getParser()->parse($input);

        // StandardOutput is only supported so far.
        $this->getOutput()->output($this->createFormatter()->generate($parsedValues));
    }

    /**
     * @param FormatterInterface $format
     * @return $this
     */
    public function setFormat(FormatterInterface $format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param ParserInterface $parser
     * @return $this
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * @return ParserInterface
     */
    public function getParser()
    {
        if ($this->parser) {
            return $this->parser;
        }
        return new SwaggerParser();
    }

    /**
     * @return FormatterInterface
     */
    private function createFormatter()
    {
        if ($this->format === FormatterInterface::TYPE_JSON) {
            return new JsonFormatter();
        }
        return new YamlFormatter();
    }

    /**
     * @param string $output
     * @return $this
     */
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
        if ($this->output) {
            return $this->output;
        }
        return new StandardOutput();
    }
}
