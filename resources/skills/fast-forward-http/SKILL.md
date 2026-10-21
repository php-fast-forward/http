---
name: fast-forward-http
description: Wire Fast Forward HTTP providers into an application container and obtain PSR-17 factories and a PSR-18 client.
license: MIT; see LICENSE
compatibility: Supports fast-forward/http ^1.2 and PHP ^8.3. Requires Composer and declared extensions; inspect the installed version. Earlier releases are outside this contract.
metadata:
  author: Fast Forward
  api-baseline: fast-forward/http ^1.2
---

# Compose HTTP services

Use this skill for an application consuming `fast-forward/http:^1.2`.
Read its instructions, manifest/lockfile and installed source before editing.
Run `composer show fast-forward/http`. For versions outside this contract,
inspect matching documentation; do not silently upgrade the application.

## First working integration

Requires PHP ^8.3, Composer's application autoloader and this package's runtime
dependencies.
With authority to install the dependency:

```sh
composer require 'fast-forward/http:^1.2'
```

Create `app.php` in the application root alongside composer.json/vendor:

```php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

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

echo "integration ready\n";
```

Run `php app.php`. It throws on a wrong result; success prints
`integration ready`. It uses no production data and starts no server.

## Wiring and failure boundaries

Store the raw provider list under `FastForward\Container\ContainerInterface::class`; the ConfigContainer exposes this as `config.FastForward\Container\ContainerInterface`. Pass the configuration to `container($config)`, then pass the returned container to the application's runtime. The provider composes HttpMessageFactoryServiceProvider and HttpClientServiceProvider. It supplies client/factories and a globals-based server request, not an HTTP server, route dispatcher or response emitter.

Without application configuration use `container(HttpServiceProvider::class)`. Resolve the extended `FastForward\Http\Message\Factory\ResponseFactoryInterface` for payload helpers, and the PSR ResponseFactoryInterface for ordinary PSR-17 creation. They are distinct services.

Put a custom ArrayServiceProvider before defaults to override an interface. The first source that successfully resolves the id wins; service-provider products are cached. Request/response factory calls create message objects, while resolving the globals-based ServerRequestInterface service can cache the request: build a fresh request explicitly for long-lived worker iterations. Missing services raise PSR-11 not-found errors; non-PSR factory failures propagate. Do not send the example.invalid request; it tests composition without a network dependency.

The helper tries aggregate sources in registration order. A PSR container or
not-found exception from one source permits fallback to another source; other
throwables propagate. Source priority is therefore the first successful resolution,
not a guarantee that an earlier broken factory terminates lookup. Nested provider
list errors during helper composition are caught; if services are absent, inspect
the raw configuration and resolve the provider directly to diagnose the failure.

## Verify integration

Run the [complete example](examples/integration.php) against the application's
autoloader in a disposable process. It checks success and negative cases:

```sh
php /path/to/fast-forward-http/examples/integration.php ./vendor/autoload.php
```

Expected final marker: `fast-forward-http: ok`. Keep application-specific regression
tests in its existing PHPUnit suite, with each fixture class in its same-named
file. File copying, host discovery and completed agent tasks are different checks.
For optional copying/synchronization load
[installation and lifecycle](references/installation.md).
