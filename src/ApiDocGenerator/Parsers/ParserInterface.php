<?php
namespace shmurakami\ApiDocGenerator\Parsers;

interface ParserInterface
{
    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function parse($request, $response);

}
