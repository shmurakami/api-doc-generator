<?php
namespace shmurakami\ApiDocGenerator\Parsers;

class ApidocjsParser implements ParserInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function parse($request)
    {
        return [
            'request' => $this->parseRequest($request),
            'responses' => $this->parseResponse($request),
        ];
    }

    private function parseRequest($request)
    {
    }

    private function parseResponse($responses)
    {

    }

    private function parseResponseSchema($objects)
    {
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
