<?php
namespace shmurakami\ApiDocGenerator\Parsers;

interface ParserInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function parse($request);

}
