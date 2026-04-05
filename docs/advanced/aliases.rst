Aliases
=======

The default setup relies heavily on aliases so you can request standard PSR interfaces and still
receive a concrete implementation automatically.

Alias Map
---------

.. list-table::
   :header-rows: 1
   :widths: 38 32 30

   * - Requested identifier
     - Resolves to
     - Why this alias exists
   * - ``Psr\Http\Message\RequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create PSR-7 request objects
   * - ``Psr\Http\Message\ResponseFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create plain PSR-17 responses
   * - ``Psr\Http\Message\ServerRequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create server requests manually
   * - ``Psr\Http\Message\StreamFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create plain PSR-17 streams
   * - ``Psr\Http\Message\UploadedFileFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create uploaded files
   * - ``Psr\Http\Message\UriFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - One factory can create URIs
   * - ``Nyholm\Psr7Server\ServerRequestCreatorInterface``
     - ``Nyholm\Psr7Server\ServerRequestCreator``
     - You code against the interface instead of the concrete class
   * - ``FastForward\Http\Message\Factory\ResponseFactoryInterface``
     - ``FastForward\Http\Message\Factory\ResponseFactory``
     - Adds convenience methods for common response types
   * - ``FastForward\Http\Message\Factory\StreamFactoryInterface``
     - ``FastForward\Http\Message\Factory\StreamFactory``
     - Adds payload-aware stream creation

What This Means In Practice
---------------------------

- All PSR-17 factory interfaces resolve to the same underlying ``Psr17Factory`` instance in the
  default container setup.
- You can type-hint the standard interfaces in your own services and stay decoupled from concrete
  implementations.
- You can request the Fast Forward convenience interfaces when you want extra helper methods that
  do not exist in the PSR interfaces.

Provider Instances Are Also Registered
--------------------------------------

Because ``HttpServiceProvider`` extends ``AggregateServiceProvider``, the following provider
instances are also available by class name:

- ``FastForward\Http\ServiceProvider\HttpServiceProvider``
- ``FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider``
- ``FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider``

This is mostly useful for inspection, debugging, or advanced composition, not for day-to-day
application code.
