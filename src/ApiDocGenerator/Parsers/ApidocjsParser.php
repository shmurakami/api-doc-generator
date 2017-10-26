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
            'response' => $this->parseResponse($response),
        ];
    }

    private function parseRequest($request)
    {
        return $this->parseSchema('',$request);
    }

    private function parseResponse($responses)
    {
        return $this->parseSchema('', $responses);
    }

    private function parseSchema($prefix, $schema)
    {
        $properties = [];
        foreach ((array)$schema as $key => $object) {
            if ($prefix) {
                $key = "$prefix.$key";
            }

            $parsed = [];
            switch (true) {
                case is_object($object):
                    $parsedObject = $this->parseObject($key, $object);
                    $parsed = [
                        [
                            'type' => 'Object',
                            'name' => $key,
                        ],
                    ];
                    foreach ($parsedObject as $property) {
                        $parsed[] = $property;
                    }
                    break;
                case is_array($object):
                    $parsed = $this->parseArray($key, $object);
                    break;
                case is_int($object) || is_float($object):
                    $parsed = $this->parseNumber($key, $object);
                    break;
                case is_string($object):
                    $parsed = $this->parseString($key, $object);
                    break;
                case is_bool($object):
                    $parsed = $this->parseBool($key, $object);
                    break;
            }
            foreach ($parsed as $property) {
                $properties[] = $property;
            }
        }
        return $properties;
    }

    private function parseObject($name, $objects)
    {
        $properties = [];

        foreach ((array)$objects as $key => $object) {
            if ($name) {
                $key = "$name.$key";
            }

            $parsed = [];
            switch (true) {
                case is_object($object):
                    $parsed = $this->parseObject($key, $object);
                    break;
                case is_array($object):
                    $parsed = $this->parseArray($key, $object);
                    break;
                case is_int($object) || is_float($object):
                    $parsed = $this->parseNumber($key, $object);
                    break;
                case is_string($object):
                    $parsed = $this->parseString($key, $object);
                    break;
                case is_bool($object):
                    $parsed = $this->parseBool($key, $object);
                    break;
            }
            foreach ($parsed as $property) {
                $properties[] = $property;
            }
        }
        return $properties;
    }

    private function parseArray($name, $array)
    {
        $item = array_shift($array);
        if ($item === null) {
            return [
                'name' => $name,
                'type' => 'Array',
            ];
        }

        if (is_object($item)) {
            $properties = $this->parseObject($name, $item);
            $parsed = [
                [
                    'type' => 'Object[]',
                    'name' => $name,
                ],
            ];
            foreach ($properties as $property) {
                $parsed[] = $property;
            }
            return $parsed;
        }

        if (is_int($item) || is_float($item)) {
            $type = 'Number[]';
        } else if (is_string($item)) {
            $type = 'String[]';
        } else {
            $type = 'Boolean[]';
        }

        // TODO nested array?

        return [
            [
                'name' => $name,
                'type' => $type,
            ],
        ];
    }

    private function parseNumber($name, $responses)
    {
        return [
            [
                'name' => $name,
                'type' => 'Number',
            ],
        ];
    }

    private function parseString($name, $responses)
    {
        return [
            [
                'name' => $name,
                'type' => 'String',
            ],
        ];
    }

    private function parseBool($name, $responses)
    {
        return [
            [
                'name' => $name,
                'type' => 'Boolean',
            ],
        ];
    }

}
