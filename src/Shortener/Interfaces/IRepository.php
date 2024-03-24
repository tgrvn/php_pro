<?php

namespace App\Shortener\Interfaces;

use App\Shortener\Exceptions\DataNotFoundException;

interface IRepository
{
    public function store(string $data, string $code);

    /**
     * @param string $id
     * @return array
     * @throws DataNotFoundException
     *
     */
    public function get(string $id): array;
}