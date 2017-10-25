<?php
namespace shmurakami\ApiDocGenerator\Tests\Parsers;

use PHPUnit_Framework_TestCase;
use shmurakami\ApiDocGenerator\Parsers\SwaggerParser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    /** @var \shmurakami\ApiDocGenerator\Parsers\SwaggerParser */
    private $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new SwaggerParser();
    }

    /**
     * @expectedException \shmurakami\ApiDocGenerator\Exceptions\InvalidValueException
     */
    public function testParse_invalidArgument()
    {
        $invalidInput = [];
        $this->parser->parse($invalidInput);
    }

    public function testParse()
    {
        $request = (object)[
            'bool'   => true,
            'int'    => 0,
            'string' => 'string',
            'float'  => 0.01,
            'array'  => [0, 1, 2,],
            'object' => (object)[
                'key' => 'value',
            ],
            'nested' => [
                (object)[
                    'int' => 1,
                ],
                (object)[
                    'int' => 2,
                ],
            ],
        ];

        $expect = [
            'request' => [],
            'responses' => [
                200 => [
                    'description' => '',
                    'schema'      => [
                        'type'       => 'object',
                        'properties' => [
                            'bool'   => ['type' => 'boolean', 'description' => '',],
                            'int'    => ['type' => 'integer', 'description' => '',],
                            'string' => ['type' => 'string', 'description' => '',],
                            'float'  => ['type' => 'number', 'description' => '',],
                            'array'  => [
                                'type'  => 'array',
                                'items' => [
                                    'type' => 'integer', 'description' => '',
                                ],
                            ],
                            'object' => [
                                'type'       => 'object',
                                'properties' => [
                                    'key' => ['type' => 'string', 'description' => '',],
                                ],
                            ],
                            'nested' => [
                                'type'  => 'array',
                                'items' => [
                                    'type'       => 'object',
                                    'properties' => [
                                        'int' => ['type' => 'integer', 'description' => '',],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertSame($expect, $this->parser->parse($request));
    }

    public function testParse_array()
    {
        $request = [
            (object)[
                'id'            => 1,
                'name'          => 'name_val',
                'nested_object' =>
                    (object)[
                        'nested_bool' => true,
                    ],
            ],
            (object)[
                'id'            => 2,
                'name'          => 'name_val2',
                'nested_object' =>
                    (object)[
                        'nested_bool' => false,
                    ],
            ],
        ];

        $expect = [
            'request' => [],
            'responses' => [
                200 => [
                    'description' => '',
                    'schema'      => [
                        'type'  => 'array',
                        'items' => [
                            'type'       => 'object',
                            'properties' => [
                                'id'            => ['type' => 'integer', 'description' => '',],
                                'name'          => ['type' => 'string', 'description' => '',],
                                'nested_object' => [
                                    'type'       => 'object',
                                    'properties' => [
                                        'nested_bool' => ['type' => 'boolean', 'description' => '',],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertSame($expect, $this->parser->parse($request));

    }

}
