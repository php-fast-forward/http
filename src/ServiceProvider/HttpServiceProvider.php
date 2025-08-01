<?php

namespace FastForward\Http\ServiceProvider;

use FastForward\Container\ServiceProvider\AggregateServiceProvider;
use FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider;
use FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider;
use Interop\Container\ServiceProviderInterface;

final class HttpServiceProvider implements ServiceProviderInterface
{
    private ServiceProviderInterface $serviceProvider;

    public function __construct()
    {
        $this->serviceProvider = new AggregateServiceProvider(
            new HttpMessageFactoryServiceProvider(),
            new HttpClientServiceProvider(),
        );
    }

    public function getFactories(): array
    {
        return $this->serviceProvider->getFactories();
    }

    public function getExtensions(): array
    {
        return $this->serviceProvider->getExtensions();
    }
}
