<?php

namespace App\UrlShortener\Repositories;

use App\UrlShortener\FileManager;

class UrlRepository
{
    public function __construct(
        protected FileManager $fileManager
    )
    {
    }

    public function find(string $needle, string $by = 'code'): ?array
    {
        $data = $this->fileManager->getData();

        foreach ($data as $d) {
            if ($d[$by] === $needle) return $d;
        }

        return null;
    }

    public function save(array $data): void
    {
        if (!is_null($this->find($data['url'], 'url'))) return;
        $this->fileManager->setData($data);
        $this->fileManager->setToStorage();
    }
}