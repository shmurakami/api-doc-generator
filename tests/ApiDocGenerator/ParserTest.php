<?php
namespace shmurakami\ApiDocGenerator\Tests;

use shmurakami\ApiDocGenerator\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var \shmurakami\ApiDocGenerator\Parser */
    private $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new Parser();
    }

    /**
     * @expectedException \shmurakami\ApiDocGenerator\Exceptions\InvalidValueException
     */
    public function testParse_invalidArgument()
    {
        $invalidInput = 'invalid';
        $this->parser->parse($invalidInput);
    }

    public function testParse()
    {
        $json = '{"bool":true,"int":0,"string":"string","float":0.01,"array":[0,1,2],"object":{"key":"value"},"nested":[{"int":1},{"int":2}]}';

        $expect = [
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
                                'type' => 'object',
                                'properties' => [
                                    'key' => ['type' => 'string', 'description' => '',],
                                ],
                            ],
                            'nested' => [
                                'type' => 'array',
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

        $this->assertSame($expect, $this->parser->parse($json));
    }

    public function testParse_array()
    {
        $json = '[{"id":1,"name":"name_val","nested_object":{"nested_bool":true}},{"id":2,"name":"name_val2","nested_object":{"nested_bool":false}}]';

        $expect = [
            'responses' => [
                200 => [
                    'description' => '',
                    'schema'      => [
                        'type'  => 'array',
                        'items' => [
                            'type'       => 'object',
                            'properties' => [
                                'id'   => ['type' => 'integer', 'description' => '',],
                                'name' => ['type' => 'string', 'description' => '',],
                                'nested_object' => [
                                    'type' => 'object',
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

        $this->assertSame($expect, $this->parser->parse($json));

    }


}
