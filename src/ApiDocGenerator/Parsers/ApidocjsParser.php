<?php
namespace shmurakami\ApiDocGenerator\Parsers;

class ApidocjsParser implements ParserInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function parse($request, $response)
    {
        return [
            'request' => $this->parseRequest($request),
            'responses' => $this->parseResponse($request),
        ];
    }

    private function parseRequest($request)
    {
        $parsed = $this->parseSchema($request);


//        ['type' => 'Boolean', 'name' => 'bool',],
//                ['type' => 'Number', 'name' => 'int',],
//                ['type' => 'String', 'name' => 'string',],
//                ['type' => 'Number', 'name' => 'float',],
//                ['type' => 'Number[]', 'name' => 'array',],
//                ['type' => 'Object', 'name' => 'object',],
//                ['type' => 'String', 'name' => 'object.key',],
//                ['type' => 'Object[]', 'name' => 'nested',],
//                ['type' => 'Number', 'name' => 'nested.int',],
    }

    private function parseResponse($responses)
    {
        return [];
    }

    private function parseSchema($schema)
    {
        switch (true) {
            case is_object($schema):
                return $this->parseObject($schema);
            case is_array($schema):
                return $this->parseArray($schema);
            case is_int($schema):
                return $this->parseInt($schema);
            case is_float($schema):
                return $this->parseFloat($schema);
            case is_string($schema):
                return $this->parseString($schema);
            case is_bool($schema):
                return $this->parseBool($schema);
            default:
                return [];
        }
    }

    private function parseObject($responses)
    {
    }

    private function parseArray($responses)
    {
    }

    private function parseInt($responses)
    {
    }

    private function parseFloat($responses)
    {
    }

    private function parseString($responses)
    {
    }

    private function parseBool($responses)
    {
    }

}
