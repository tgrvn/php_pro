<?php

use App\Shortener\DataConverter;
use App\Shortener\Helpers\UrlValidator;
use App\Shortener\Repositories\FileRepository;
use GuzzleHttp\Client;

require_once __DIR__ . '/../vendor/autoload.php';

$client = new Client();
$urlValidator = new UrlValidator($client);

$fileRepository = new FileRepository();

$converter = new DataConverter($fileRepository, $urlValidator);

$code = $converter->encode('https://google.com');
$converter->decode($code);

exit();