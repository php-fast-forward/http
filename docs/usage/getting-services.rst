Getting Services
================

``HttpServiceProvider`` does not ask you to instantiate clients or factories manually. You register
the provider once, then request services from the container by interface or class name.

Register the Provider
---------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

Which Identifier Should You Request?
------------------------------------

The most common services are listed below.

.. list-table::
   :header-rows: 1
   :widths: 34 26 40

   * - Container entry
     - Returns
     - Typical use
   * - ``Psr\Http\Message\RequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Create outbound requests
   * - ``Psr\Http\Message\ResponseFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Create plain PSR-17 responses
   * - ``Psr\Http\Message\ServerRequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Build server requests manually
   * - ``Psr\Http\Message\StreamFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Create plain PSR-17 streams
   * - ``Psr\Http\Message\UploadedFileFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Create uploaded file objects
   * - ``Psr\Http\Message\UriFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Build URI objects
   * - ``FastForward\Http\Message\Factory\ResponseFactoryInterface``
     - ``FastForward\Http\Message\Factory\ResponseFactory``
     - Create JSON, HTML, text, empty, and redirect responses
   * - ``FastForward\Http\Message\Factory\StreamFactoryInterface``
     - ``FastForward\Http\Message\Factory\StreamFactory``
     - Create JSON payload streams in addition to normal streams
   * - ``Nyholm\Psr7Server\ServerRequestCreatorInterface``
     - ``Nyholm\Psr7Server\ServerRequestCreator``
     - Build a server request from PHP globals explicitly
   * - ``Psr\Http\Message\ServerRequestInterface``
     - A request created with ``fromGlobals()``
     - Read the current incoming HTTP request
   * - ``Psr\Http\Client\ClientInterface``
     - ``Symfony\Component\HttpClient\Psr18Client``
     - Send outbound HTTP requests
   * - ``Symfony\Component\HttpClient\HttpClient``
     - Result of ``HttpClient::create()``
     - Access the lower-level Symfony client service

The Two ResponseFactoryInterface Types
--------------------------------------

This package exposes two different interfaces named ``ResponseFactoryInterface``:

- ``Psr\Http\Message\ResponseFactoryInterface`` gives you the plain PSR-17 method
  ``createResponse()``.
- ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` adds convenience methods such as
  ``createResponseFromPayload()`` and ``createResponseRedirect()``.

If you want JSON, HTML, text, redirects, or empty responses, request the Fast Forward interface.

Common Retrieval Example
------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface as FastForwardResponseFactory;
   use FastForward\Http\Message\Factory\StreamFactoryInterface as FastForwardStreamFactory;
   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use Nyholm\Psr7Server\ServerRequestCreatorInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;
   use Psr\Http\Message\ServerRequestInterface;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $responseFactory = $container->get(FastForwardResponseFactory::class);
   $streamFactory = $container->get(FastForwardStreamFactory::class);
   $requestCreator = $container->get(ServerRequestCreatorInterface::class);
   $serverRequest = $container->get(ServerRequestInterface::class);
   $client = $container->get(ClientInterface::class);

Important Behavior
------------------

- Services are created lazily. Nothing is instantiated until you call ``get()``.
- Services are cached by the container. Repeated calls to the same identifier return the same
  service instance within that container.
- All PSR-17 interfaces point to the same underlying ``Psr17Factory`` instance in the default
  setup.

For a full inventory of services and classes, see :doc:`../api/aggregated-services`.
