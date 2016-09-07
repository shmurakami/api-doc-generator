<?php
namespace shmurakami\SwaggerGenerator;

use shmurakami\SwaggerGenerator\Formatters\FormatterInterface;
use shmurakami\SwaggerGenerator\Formatters\JsonFormatter;
use shmurakami\SwaggerGenerator\Formatters\YamlFormatter;
use shmurakami\SwaggerGenerator\Outputs\FileOutput;
use shmurakami\SwaggerGenerator\Outputs\OutputInterface;
use shmurakami\SwaggerGenerator\Outputs\StandardOutput;

class SwaggerGenerator
{
    /** @var Parser */
    private $parser;

    /** @var string */
    private $format;

    /** @var string output file path */
    private $output;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function generate($input)
    {
        $parsedValues = $this->parser->parse($input);

        // StandardOutput is only supported so far.
        $this->createOutput()->output($this->createFormatter()->generate($parsedValues));
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
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
     * TODO formatと渡す値の扱いが全然違うしoutput側のinterfaceが統一されてない
     *
     * @param string $output
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @return OutputInterface
     */
    private function createOutput()
    {
        if (is_null($this->output)) {
            return new StandardOutput();
        }

        $fileOutput = new FileOutput($this->output);
        return $fileOutput;
    }
}
