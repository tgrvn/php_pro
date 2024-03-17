<?php

namespace App\UrlShortener;

use App\UrlShortener\Helpers\UrlValidator;
use App\UrlShortener\Interfaces\IUrlDecoder;
use App\UrlShortener\Interfaces\IUrlEncoder;
use App\UrlShortener\Repositories\UrlRepository;

class UrlConverter implements IUrlEncoder, IUrlDecoder
{
    public function __construct(
        protected UrlRepository $urlRepository,
        protected UrlValidator  $validator,
        protected int           $codeLength = 10
    )
    {
    }

    public
    function decode(string $code): string
    {
        try {
            $data = $this->urlRepository->find($code);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        return $data['url'];
    }

    /**
     * @throws \Exception
     */
    public
    function encode(string $url): string
    {
        if (false === $this->validator->validateCodeStatus($url) &&
            false === $this->validator->validateUrlString($url)) {
            throw new \InvalidArgumentException('failed to validate url');
        }

        $data = [
            'url' => $url,
            'code' => substr(md5($url), 0, $this->codeLength)
        ];

        try {
            $this->urlRepository->save($data);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        return $data['code'];
    }
}