<?php

namespace App\UrlShortener\Interfaces;

interface IValidateUrl
{
    /**
     * @param string $url
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validateUrlString(string $url): bool;

    /**
     * @param string $url
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validateCodeStatus(string $url): bool;
}