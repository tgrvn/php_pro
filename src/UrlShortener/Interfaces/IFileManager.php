<?php

namespace App\UrlShortener\Interfaces;

interface IFileManager
{
    public function connectToStorage(): void;

    public function setToStorage(): void;
}