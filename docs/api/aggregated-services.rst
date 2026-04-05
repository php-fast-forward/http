Aggregated Services
===================

This page lists the most important services and classes you gain by installing and registering
``fast-forward/http``.

Providers
---------

.. list-table::
   :header-rows: 1
   :widths: 40 60

   * - Class
     - Purpose
   * - ``FastForward\Http\ServiceProvider\HttpServiceProvider``
     - Aggregate entry point for the full HTTP stack
   * - ``FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider``
     - Registers PSR-17 factories, request creation, and Fast Forward convenience factories
   * - ``FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider``
     - Registers the Symfony-backed PSR-18 client

Factory And Request Services
----------------------------

.. list-table::
   :header-rows: 1
   :widths: 36 32 32

   * - Identifier
     - Concrete class
     - Source package
   * - ``Psr\Http\Message\RequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\ResponseFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\ServerRequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\StreamFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\UploadedFileFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\UriFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - ``fast-forward/http-factory``
   * - ``Nyholm\Psr7Server\ServerRequestCreatorInterface``
     - ``Nyholm\Psr7Server\ServerRequestCreator``
     - ``fast-forward/http-factory``
   * - ``Psr\Http\Message\ServerRequestInterface``
     - ``ServerRequestCreator::fromGlobals()`` result
     - ``fast-forward/http-factory``

Fast Forward Convenience Factories
----------------------------------

.. list-table::
   :header-rows: 1
   :widths: 36 32 32

   * - Identifier
     - Concrete class
     - What makes it special
   * - ``FastForward\Http\Message\Factory\ResponseFactoryInterface``
     - ``FastForward\Http\Message\Factory\ResponseFactory``
     - Adds JSON, HTML, text, redirect, and empty response helpers
   * - ``FastForward\Http\Message\Factory\StreamFactoryInterface``
     - ``FastForward\Http\Message\Factory\StreamFactory``
     - Adds JSON payload stream creation

HTTP Client Services
--------------------

.. list-table::
   :header-rows: 1
   :widths: 36 32 32

   * - Identifier
     - Concrete class
     - Source package
   * - ``Psr\Http\Client\ClientInterface``
     - ``Symfony\Component\HttpClient\Psr18Client``
     - ``fast-forward/http-client``
   * - ``Symfony\Component\HttpClient\HttpClient``
     - Result of ``HttpClient::create()``
     - ``fast-forward/http-client``

Concrete Response And Stream Classes Returned By The Helpers
------------------------------------------------------------

These classes are not fetched directly from the container in normal usage, but they are important
because the Fast Forward convenience factories create them for you.

.. list-table::
   :header-rows: 1
   :widths: 34 28 38

   * - Class
     - Source package
     - Created by
   * - ``FastForward\Http\Message\HtmlResponse``
     - ``fast-forward/http-message``
     - ``ResponseFactory::createResponseFromHtml()``
   * - ``FastForward\Http\Message\TextResponse``
     - ``fast-forward/http-message``
     - ``ResponseFactory::createResponseFromText()``
   * - ``FastForward\Http\Message\JsonResponse``
     - ``fast-forward/http-message``
     - ``ResponseFactory::createResponseFromPayload()``
   * - ``FastForward\Http\Message\EmptyResponse``
     - ``fast-forward/http-message``
     - ``ResponseFactory::createResponseNoContent()``
   * - ``FastForward\Http\Message\RedirectResponse``
     - ``fast-forward/http-message``
     - ``ResponseFactory::createResponseRedirect()``
   * - ``FastForward\Http\Message\JsonStream``
     - ``fast-forward/http-message``
     - ``StreamFactory::createStreamFromPayload()``
