<?php

namespace App\UrlShortener\Interfaces;

interface IUrlEncoder
{
    /**
     * @param string $url
     * @return string
     * @throws \InvalidArgumentException
     */
    public function encode(string $url): string;
}