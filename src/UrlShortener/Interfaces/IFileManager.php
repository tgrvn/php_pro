<?php

namespace App\UrlShortener\Interfaces;

interface IFileManager
{
    public function connectToStorage(): void;

    public function setToStorage(): void;

    public function getData(): array;

    public function setData(array $data): void;
}