# Fast Forward HTTP

[![PHP Version](https://img.shields.io/badge/php-^8.3-777BB4?logo=php&logoColor=white)](https://www.php.net/releases/)
[![Composer Package](https://img.shields.io/badge/composer-fast--forward%2Fhttp-F28D1A.svg?logo=composer&logoColor=white)](https://packagist.org/packages/fast-forward/clock)
[![Tests](https://img.shields.io/github/actions/workflow/status/php-fast-forward/http/tests.yml?logo=githubactions&logoColor=white&label=tests&color=22C55E)](https://github.com/php-fast-forward/http/actions/workflows/tests.yml)
[![Coverage](https://img.shields.io/badge/coverage-phpunit-4ADE80?logo=php&logoColor=white)](https://php-fast-forward.github.io/http/coverage/index.html)
[![Docs](https://img.shields.io/github/deployments/php-fast-forward/http/github-pages?logo=readthedocs&logoColor=white&label=docs&labelColor=1E293B&color=38BDF8&style=flat)](https://php-fast-forward.github.io/http/index.html)
[![License](https://img.shields.io/github/license/php-fast-forward/http?color=64748B)](LICENSE)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/php-fast-forward?logo=githubsponsors&logoColor=white&color=EC4899)](https://github.com/sponsors/php-fast-forward)

[![PSR-7](https://img.shields.io/badge/PSR--7-http--message-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-7/)
[![PSR-11](https://img.shields.io/badge/PSR--11-container-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-11/)
[![PSR-17](https://img.shields.io/badge/PSR--17-http--factory-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-17/)
[![PSR-18](https://img.shields.io/badge/PSR--18-http--client-777BB4?logo=php&logoColor=white)](https://www.php-fig.org/psr/psr-18/)

Fast Forward HTTP is the aggregate HTTP package of the Fast Forward ecosystem.

It is designed for developers who want a practical starting point for HTTP work without wiring each
piece manually. Install one package, register one provider, and you get the default Fast Forward
HTTP stack in your container.

## What You Get

- PSR-17 factories for requests, responses, server requests, streams, uploaded files, and URIs
- A PSR-18 HTTP client backed by Symfony HttpClient
- A `ServerRequestInterface` created from PHP globals
- Fast Forward convenience factories for JSON, HTML, text, redirect, empty responses, and payload streams
- One aggregate `HttpServiceProvider` that wires the stack together

## Installation

```bash
composer require fast-forward/http
```

## Quickstart

```php
<?php

declare(strict_types=1);

use FastForward\Http\Message\Factory\ResponseFactoryInterface;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use function FastForward\Container\container;

$container = container(new HttpServiceProvider());

$responseFactory = $container->get(ResponseFactoryInterface::class);

$response = $responseFactory->createResponseFromPayload([
    'message' => 'Hello, Fast Forward HTTP!',
    'ok' => true,
]);

echo $response->getHeaderLine('Content-Type');
// application/json; charset=utf-8
```

## Main Services

| Identifier | Default concrete service | Purpose |
| --- | --- | --- |
| `Psr\Http\Message\RequestFactoryInterface` | `Nyholm\Psr7\Factory\Psr17Factory` | Create outbound requests |
| `Psr\Http\Message\ResponseFactoryInterface` | `Nyholm\Psr7\Factory\Psr17Factory` | Create plain PSR-17 responses |
| `FastForward\Http\Message\Factory\ResponseFactoryInterface` | `FastForward\Http\Message\Factory\ResponseFactory` | Create JSON, HTML, text, redirect, and empty responses |
| `FastForward\Http\Message\Factory\StreamFactoryInterface` | `FastForward\Http\Message\Factory\StreamFactory` | Create payload-aware JSON streams |
| `Psr\Http\Message\ServerRequestInterface` | `ServerRequestCreator::fromGlobals()` result | Access the current incoming request |
| `Psr\Http\Client\ClientInterface` | `Symfony\Component\HttpClient\Psr18Client` | Send outbound HTTP requests |

## Documentation

See the documentation sources in [`docs/`](docs/) for:

- installation and quickstart
- retrieving services from the container
- responses, streams, and server requests
- advanced customization and aliasing
- aggregated services and compatibility notes

## Related Packages

- [`fast-forward/container`](https://github.com/php-fast-forward/container)
- [`fast-forward/http-client`](https://github.com/php-fast-forward/http-client)
- [`fast-forward/http-factory`](https://github.com/php-fast-forward/http-factory)
- [`fast-forward/http-message`](https://github.com/php-fast-forward/http-message)

## License

Fast Forward HTTP is licensed under the [MIT license](LICENSE).
