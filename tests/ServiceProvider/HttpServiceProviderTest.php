<?php

declare(strict_types=1);

/**
 * This file is part of php-fast-forward/http.
 *
 * This source file is subject to the license bundled
 * with this source code in the file LICENSE.
 *
 * @copyright Copyright (c) 2025-2026 Felipe Sayão Lobato Abreu <github@mentordosnerds.com>
 * @license   https://opensource.org/licenses/MIT MIT License
 *
 * @see       https://github.com/php-fast-forward/http
 * @see       https://github.com/php-fast-forward
 * @see       https://datatracker.ietf.org/doc/html/rfc2119
 */

namespace FastForward\Http\Tests\ServiceProvider;

use FastForward\Container\Factory\ServiceFactory;
use FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider;
use FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(HttpServiceProvider::class)]
final class HttpServiceProviderTest extends TestCase
{
    private HttpServiceProvider $provider;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->provider = new HttpServiceProvider();
    }

    /**
     * @return void
     */
    #[Test]
    public function getFactoriesWillIncludeAllAggregatedFactories(): void
    {
        $httpMessageFactoryServiceProvider = new HttpMessageFactoryServiceProvider();
        $httpClientServiceProvider = new HttpClientServiceProvider();

        $expectedFactories = array_merge(
            $httpMessageFactoryServiceProvider->getFactories(),
            $httpClientServiceProvider->getFactories(),
            [
                HttpServiceProvider::class => new ServiceFactory($this->provider),
                HttpMessageFactoryServiceProvider::class => new ServiceFactory($httpMessageFactoryServiceProvider),
                HttpClientServiceProvider::class => new ServiceFactory($httpClientServiceProvider),
            ]
        );

        $actualFactories = $this->provider->getFactories();

        foreach (array_keys($expectedFactories) as $id) {
            self::assertArrayHasKey($id, $actualFactories);
            self::assertIsCallable($actualFactories[$id]);
        }

        self::assertSameSize($expectedFactories, $actualFactories);
    }

    /**
     * @return void
     */
    #[Test]
    public function getExtensionsWillIncludeAllAggregatedExtensions(): void
    {
        $expectedExtensions = array_merge(
            (new HttpMessageFactoryServiceProvider())->getExtensions(),
            (new HttpClientServiceProvider())->getExtensions()
        );

        $actualExtensions = $this->provider->getExtensions();

        foreach (array_keys($expectedExtensions) as $id) {
            self::assertArrayHasKey($id, $actualExtensions);
            self::assertIsCallable($actualExtensions[$id]);
        }

        self::assertSameSize($expectedExtensions, $actualExtensions);
    }
}
