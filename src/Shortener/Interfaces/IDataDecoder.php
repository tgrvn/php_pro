<?php

namespace App\Shortener\Interfaces;

interface IDataDecoder
{
    /**
     * @param string $code
     * @return string
     * @throws \InvalidArgumentException
     */
    public function decode(string $code): string;
}