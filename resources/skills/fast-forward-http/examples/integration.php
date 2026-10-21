<?php

declare(strict_types=1);

require $argv[1] ?? dirname(__DIR__, 4) . '/vendor/autoload.php';

use FastForward\Config\ArrayConfig;
use FastForward\Container\ContainerInterface;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface;
use function FastForward\Container\container;

$config = new ArrayConfig([ContainerInterface::class => [HttpServiceProvider::class]]);
$container = container($config);
$response = $container->get(ResponseFactoryInterface::class)->createResponse(202);
$request = $container->get(RequestFactoryInterface::class)->createRequest('GET', 'https://example.invalid/');
$client = $container->get(ClientInterface::class);
if ($response->getStatusCode() !== 202 || $request->getMethod() !== 'GET' || !$client instanceof ClientInterface) {
    throw new RuntimeException('HTTP composition failed.');
}
try {
    $container->get('application.missing');
    throw new RuntimeException('Missing service unexpectedly resolved.');
} catch (\Psr\Container\NotFoundExceptionInterface) {
}

echo "fast-forward-http: ok\n";
