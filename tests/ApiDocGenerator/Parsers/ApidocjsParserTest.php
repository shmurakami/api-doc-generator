<?php
namespace shmurakami\ApiDocGenerator\Tests\Parsers;

use PHPUnit_Framework_TestCase;
use shmurakami\ApiDocGenerator\Parsers\ApidocjsParser;

class ApidocjsParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApidocjsParser
     */
    private $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new ApidocjsParser();
    }

    public function testParse()
    {
        $request = [
            'bool'   => true,
            'int'    => 0,
            'string' => 'string',
            'float'  => 0.01,
            'array'  => [0, 1, 2,],
            'object' => (object)[
                'key' => 'value',
                'foo' => 0,
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

        $response = (object)[
            'bool'   => true,
            'int'    => 0,
            'string' => 'string',
            'float'  => 0.01,
            'array'  => [0, 1, 2,],
            'object' => (object)[
                'key' => 'value',
                'foo' => 0,
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
            'request'   => [
                ['type' => 'Boolean', 'name' => 'bool',],
                ['type' => 'Number', 'name' => 'int',],
                ['type' => 'String', 'name' => 'string',],
                ['type' => 'Number', 'name' => 'float',],
                ['type' => 'Number[]', 'name' => 'array',],
                ['type' => 'Object', 'name' => 'object',],
                ['type' => 'String', 'name' => 'object.key',],
                ['type' => 'Number', 'name' => 'object.foo',],
                ['type' => 'Object[]', 'name' => 'nested',],
                ['type' => 'Number', 'name' => 'nested.int',],
            ],
            'response' => [
                ['type' => 'Boolean', 'name' => 'bool',],
                ['type' => 'Number', 'name' => 'int',],
                ['type' => 'String', 'name' => 'string',],
                ['type' => 'Number', 'name' => 'float',],
                ['type' => 'Number[]', 'name' => 'array',],
                ['type' => 'Object', 'name' => 'object',],
                ['type' => 'String', 'name' => 'object.key',],
                ['type' => 'Number', 'name' => 'object.foo',],
                ['type' => 'Object[]', 'name' => 'nested',],
                ['type' => 'Number', 'name' => 'nested.int',],
            ],
        ];

        $this->assertEquals($expect, $this->parser->parse($request, $response));
    }

}
