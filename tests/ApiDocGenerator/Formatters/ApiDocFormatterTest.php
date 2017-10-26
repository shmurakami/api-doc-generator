<?php
namespace shmurakami\ApiDocGenerator\Formatters;

use PHPUnit_Framework_TestCase;

class ApiDocFormatterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApiDocFormatter
     */
    private $formatter;

    protected function setUp()
    {
        parent::setUp();
        $this->formatter = new ApiDocFormatter();
    }

    public function testFormat()
    {
        $values = [
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

        // TODO have to support method, url, etc
        $expect = implode("\n", [
            '/**',
            ' * @apiParam {Boolean} bool ',
            ' * @apiParam {Number} int ',
            ' * @apiParam {String} string ',
            ' * @apiParam {Number} float ',
            ' * @apiParam {Number[]} array ',
            ' * @apiParam {Object} object ',
            ' * @apiParam {String} object.key ',
            ' * @apiParam {Number} object.foo ',
            ' * @apiParam {Object[]} nested ',
            ' * @apiParam {Number} nested.int ',
            ' * ',
            ' * @apiSuccess {Boolean} bool ',
            ' * @apiSuccess {Number} int ',
            ' * @apiSuccess {String} string ',
            ' * @apiSuccess {Number} float ',
            ' * @apiSuccess {Number[]} array ',
            ' * @apiSuccess {Object} object ',
            ' * @apiSuccess {String} object.key ',
            ' * @apiSuccess {Number} object.foo ',
            ' * @apiSuccess {Object[]} nested ',
            ' * @apiSuccess {Number} nested.int ',
            ' */',
        ]);
        $this->assertEquals($expect, $this->formatter->format($values));
    }

}
