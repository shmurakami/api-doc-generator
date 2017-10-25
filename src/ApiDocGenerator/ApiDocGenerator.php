<?php
namespace shmurakami\ApiDocGenerator;

use shmurakami\ApiDocGenerator\Formatters\FormatterInterface;
use shmurakami\ApiDocGenerator\Formatters\JsonFormatter;
use shmurakami\ApiDocGenerator\Formatters\YamlFormatter;
use shmurakami\ApiDocGenerator\Outputs\FileOutput;
use shmurakami\ApiDocGenerator\Outputs\OutputInterface;
use shmurakami\ApiDocGenerator\Outputs\StandardOutput;

class ApiDocGenerator
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
