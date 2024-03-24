<?php

namespace App\Shortener\Repositories;

use App\Shortener\Exceptions\DataNotFoundException;
use App\Shortener\Interfaces\IRepository;

class FileRepository implements IRepository
{
    protected string $basePath = __DIR__ . '/../../../storage/';
    protected string $fileName = 'shortener.json';
    protected array $data = [];

    public function __construct()
    {
        $this->connectToStorage();
    }

    public function connectToStorage(): void
    {
        if (!file_exists($this->basePath . $this->fileName)) {
            $this->setToStorage();
        }

        $data = file_get_contents($this->basePath . $this->fileName);

        if ($data) {
            $this->data = json_decode($data, true);
        }
    }

    public function setToStorage(): void
    {
        file_put_contents($this->basePath . $this->fileName, json_encode($this->data));
    }

    public function store(string $data, string $code): void
    {
        $data = [
            'data' => $data,
            'code' => $code
        ];

        $this->data[] = $data;
    }

    public function get(string $id): array
    {
        if (count($this->data) > 0) {
            foreach ($this->data as $d) {
                if ($d['code'] === $id || $d['data'] === $id) return $d;
            }
        }

        throw new DataNotFoundException();
    }

    public function __destruct()
    {
        $this->setToStorage();
    }
}