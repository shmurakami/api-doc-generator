<?php
namespace shmurakami\ApiDocGenerator\Formatters;

class ApiDocFormatter implements FormatterInterface
{

    public function format($values)
    {
        $request = $values['request'];
        $response = $values['response'];

        $lines = [];
        $formattedRequest = $this->formatRequest($request);
        $formattedResponse = $this->formatResponse($response);

        foreach ($formattedRequest as $line) {
            $lines[] = $line;
        }
        $lines[] = $this->decorateLine('');
        foreach ($formattedResponse as $line) {
            $lines[] = $line;
        }

        $result = implode("\n", $lines);
        return $this->decorateAll($result);
    }

    /**
     * @param $requests
     * @return string[]
     */
    private function formatRequest($requests)
    {
        $values = [];
        foreach ($requests as $request) {
            $type = $request['type'];
            $name = $request['name'];
            $values[] = $this->decorateLine($this->formatLine("@apiParam", $type, $name));
        }
        return $values;
    }

    /**
     * @param $response
     * @return string[]
     */
    private function formatResponse($response)
    {
        $values = [];
        foreach ($response as $request) {
            $type = $request['type'];
            $name = $request['name'];
            $values[] = $this->decorateLine($this->formatLine("@apiSuccess", $type, $name));
        }
        return $values;
    }

    private function formatLine($annotation, $type, $name)
    {
        return "$annotation {{$type}} $name ";
    }

    private function decorateLine($string)
    {
        return " * $string";
    }

    private function decorateAll($string)
    {
        return <<<EOF
/**
$string
 */
EOF;
    }

}
