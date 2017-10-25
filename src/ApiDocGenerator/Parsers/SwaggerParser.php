<?php
namespace shmurakami\ApiDocGenerator\Parsers;

use shmurakami\ApiDocGenerator\Exceptions\InvalidValueException;

class SwaggerParser implements ParserInterface
{

    /**
     * @param $request
     * @return mixed
     */
    public function parse($request, $response)
    {
        if (!$response) {
            throw new InvalidValueException('failed to parse passed values');
        }

        return [
            'request' => $this->parseRequest($request),
            'responses' => $this->parseResponse($response),
        ];
    }

    private function parseRequest($request)
    {
        // TODO implement later
        return [];
    }

    private function parseResponse($responses)
    {
        return [
            200 => [
                'description' => '',
                'schema'      => $this->parseResponseSchema($responses),
            ],
        ];
    }

    private function parseResponseSchema($objects)
    {
        switch (true) {
            case is_object($objects):
                return $this->parseObject($objects);
            case is_array($objects):
                return $this->parseArray($objects);
            case is_int($objects):
                return $this->parseInt($objects);
            case is_float($objects):
                return $this->parseFloat($objects);
            case is_string($objects):
                return $this->parseString($objects);
            case is_bool($objects):
                return $this->parseBool($objects);
            default:
                return [];
        }
    }

    private function parseObject($responses)
    {
        $properties = [];
        foreach ((array)$responses as $key => $response) {
            $schema = null;
            switch (true) {
                case is_object($response):
                    $schema = $this->parseObject($response);
                    break;
                case is_array($response):
                    $schema = $this->parseArray($response);
                    break;
                case is_int($response):
                    $schema = $this->parseInt($response);
                    break;
                case is_float($response):
                    $schema = $this->parseFloat($response);
                    break;
                case is_string($response):
                    $schema = $this->parseString($response);
                    break;
                case is_bool($response):
                    $schema = $this->parseBool($responses);
                    break;
            }
            $properties[$key] = $schema;
        }

        return [
            'type'       => 'object',
            'properties' => $properties,
        ];
    }

    private function parseArray($responses)
    {
        $item = array_shift($responses);
        $items = [];
        switch (true) {
            case is_object($item):
                $items = $this->parseObject($item);
                break;
            case is_int($item):
                $items = $this->parseInt($item);
                break;
            case is_float($item):
                $items = $this->parseFloat($item);
                break;
            case is_string($item):
                $items = $this->parseString($item);
                break;
            case is_bool($responses):
                $items = $this->parseBool($responses);
                break;
            // array is impossible
        }

        return [
            'type'  => 'array',
            'items' => $items,
        ];
    }

    private function parseInt($responses)
    {
        return [
            'type'        => 'integer',
            'description' => '',
        ];
    }

    private function parseFloat($responses)
    {
        return [
            'type'        => 'number',
            'description' => '',
        ];
    }

    private function parseString($responses)
    {
        return [
            'type'        => 'string',
            'description' => '',
        ];
    }

    private function parseBool($responses)
    {
        return [
            'type'        => 'boolean',
            'description' => '',
        ];
    }

}
