<?php

namespace App\Shortener\Interfaces;

interface IValidator
{
    /**
     * @param string $data
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validate(string $data): bool;
}