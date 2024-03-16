<?php

namespace App\UrlShortener;

use App\UrlShortener\Interfaces\IFileManager;

class FileManager implements IFileManager
{
    protected string $basePath = __DIR__ . '/../../storage/';
    protected string $fileName = 'shortener.json';
    protected array $data = [];

    public function __construct()
    {
        $this->connectToStorage();
    }

    public function connectToStorage(): void
    {
        if (file_exists($this->basePath . $this->fileName)) {
            $data = file_get_contents($this->basePath . $this->fileName);
            $this->data = json_decode($data, true);
        }
    }

    public function setToStorage(): void
    {
        file_put_contents($this->basePath . $this->fileName, json_encode($this->data));
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data[] = $data;
    }
}