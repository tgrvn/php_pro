<?php

use App\UrlShortener\FileManager;
use App\UrlShortener\Helpers\UrlValidator;
use App\UrlShortener\Repositories\UrlRepository;
use App\UrlShortener\UrlConverter;

require_once __DIR__ . '/../examples/autoload.php';

$fileManager = new FileManager();
$urlRepository = new UrlRepository($fileManager);
$urlValidator = new UrlValidator();
$converter = new UrlConverter($urlRepository, $urlValidator);

echo $converter->decode('a023cfbf5f') . PHP_EOL;

try {
    $converter->encode('https://facebook.com');
} catch (Exception $e) {
    throw new Exception(
        $e->getMessage()
    );
}

exit();