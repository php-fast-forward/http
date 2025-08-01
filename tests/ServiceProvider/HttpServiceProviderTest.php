<?php

declare(strict_types=1);

namespace FastForward\Http\Tests\ServiceProvider;

use FastForward\Container\Factory\ServiceFactory;
use FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider;
use FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider;
use FastForward\Http\ServiceProvider\HttpServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(HttpServiceProvider::class)]
final class HttpServiceProviderTest extends TestCase
{
    private HttpServiceProvider $provider;

    protected function setUp(): void
    {
        $this->provider = new HttpServiceProvider();
    }

    public function testGetFactoriesWillIncludeAllAggregatedFactories(): void
    {
        $expectedFactories = array_merge(
            (new HttpMessageFactoryServiceProvider())->getFactories(),
            (new HttpClientServiceProvider())->getFactories(),
            [HttpServiceProvider::class => new ServiceFactory($this->provider)]
        );

        $actualFactories = $this->provider->getFactories();

        foreach ($expectedFactories as $id => $factory) {
            self::assertArrayHasKey($id, $actualFactories);
            self::assertIsCallable($actualFactories[$id]);
        }

        self::assertSameSize($expectedFactories, $actualFactories);
    }

    public function testGetExtensionsWillIncludeAllAggregatedExtensions(): void
    {
        $expectedExtensions = array_merge(
            (new HttpMessageFactoryServiceProvider())->getExtensions(),
            (new HttpClientServiceProvider())->getExtensions()
        );

        $actualExtensions = $this->provider->getExtensions();

        foreach ($expectedExtensions as $id => $extension) {
            self::assertArrayHasKey($id, $actualExtensions);
            self::assertIsCallable($actualExtensions[$id]);
        }

        self::assertSameSize($expectedExtensions, $actualExtensions);
    }
}
