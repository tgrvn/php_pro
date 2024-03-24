<?php

namespace App\Shortener\Exceptions;

class DataNotFoundException extends \Exception
{
    protected $message = 'Data Not Found';
}