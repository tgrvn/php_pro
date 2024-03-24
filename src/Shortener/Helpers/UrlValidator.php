<?php

namespace App\Shortener\Helpers;

use App\Shortener\Interfaces\IValidator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use http\Exception\InvalidArgumentException;

class UrlValidator implements IValidator
{
    const STATUS_CODES = [200, 201, 301, 302];

    public function __construct(
        protected ClientInterface $client
    )
    {
    }

    public function validateUrlString(string $url): bool
    {
        if (empty($url) || false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('invalid url');
        }

        return true;
    }

    public function validateCodeStatus(string $url): bool
    {
        try {
            $response = $this->client->get($url);
            $statusCode = $response->getStatusCode();
            return in_array($statusCode, self::STATUS_CODES);
        } catch (ConnectException) {
            throw new InvalidArgumentException('url inactive');
        }
    }

    public function validate(string $data): bool
    {
        $this->validateUrlString($data);
        $this->validateCodeStatus($data);
        return true;
    }
}