<?php

namespace App\UrlShortener\Helpers;

use App\UrlShortener\Interfaces\IValidateUrl;

class UrlValidator implements IValidateUrl
{
    public function validateUrlString(string $url): bool
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Error('invalid url');
        }

        return true;
    }

    public function validateCodeStatus(string $url): bool
    {
        if (false === file_get_contents($url)) {
            throw new \Error('inactive url');
        }

        return true;
    }
}