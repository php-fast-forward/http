HttpServiceProvider
===================

.. php:class:: FastForward\Http\ServiceProvider\HttpServiceProvider

   Aggregates and registers HTTP-related service providers. This class encapsulates the dependencies for HTTP client and message factory services within the container.

   **Constructor**

   .. php:method:: __construct()

      Initializes the internal service provider as an instance of AggregateServiceProvider composed of HTTP-related service providers:

      - HttpMessageFactoryServiceProvider
      - HttpClientServiceProvider

   **Usage Example**

   .. code-block:: php

      use FastForward\Http\ServiceProvider\HttpServiceProvider;
      use FastForward\Container\Container;

      $container = new Container([
          new HttpServiceProvider(),
      ]);
