<?php

declare(strict_types=1);

/**
 * This file is part of php-fast-forward/http.
 *
 * This source file is subject to the license bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/php-fast-forward/http
 * @copyright Copyright (c) 2025 Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace FastForward\Http\ServiceProvider;

use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider;
use FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider;

/**
 * Class HttpServiceProvider
 *
 * Aggregates and registers HTTP-related service providers. This class SHALL encapsulate the
 * dependencies for HTTP client and message factory services within the container.
 *
 * It MUST implement the ServiceProviderInterface and MUST delegate factory and extension
 * retrieval to the internal AggregateServiceProvider instance.
 */
final class HttpServiceProvider extends AggregateServiceProvider
{
    /**
     * Constructs the HttpServiceProvider.
     *
     * This constructor MUST initialize the internal service provider as an instance of
     * AggregateServiceProvider composed of HTTP-related service providers.
     */
    public function __construct()
    {
        parent::__construct(
            new HttpMessageFactoryServiceProvider(),
            new HttpClientServiceProvider(),
        );
    }
}
