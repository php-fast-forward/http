HttpMessageFactoryServiceProvider
=================================

Class: ``FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider``

Purpose
-------

This provider registers the PSR-17 factories, the server request creator, the globals-based
``ServerRequestInterface``, and the Fast Forward convenience factories for responses and streams.

Key Services Registered
-----------------------

.. list-table::
   :header-rows: 1
   :widths: 38 32 30

   * - Identifier
     - Concrete service
     - Notes
   * - ``Psr\Http\Message\RequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Psr\Http\Message\ResponseFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Psr\Http\Message\ServerRequestFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Psr\Http\Message\StreamFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Psr\Http\Message\UploadedFileFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Psr\Http\Message\UriFactoryInterface``
     - ``Nyholm\Psr7\Factory\Psr17Factory``
     - Alias
   * - ``Nyholm\Psr7Server\ServerRequestCreatorInterface``
     - ``Nyholm\Psr7Server\ServerRequestCreator``
     - Alias
   * - ``FastForward\Http\Message\Factory\ResponseFactoryInterface``
     - ``FastForward\Http\Message\Factory\ResponseFactory``
     - Convenience response helpers
   * - ``FastForward\Http\Message\Factory\StreamFactoryInterface``
     - ``FastForward\Http\Message\Factory\StreamFactory``
     - Convenience payload stream helper
   * - ``Psr\Http\Message\ServerRequestInterface``
     - Result of ``ServerRequestCreator::fromGlobals()``
     - Snapshot of PHP globals

Extensions
----------

This provider does not register extensions by default.

When To Use It Directly
----------------------

Use this provider directly when you want factories and request creation support but do not need the
HTTP client portion of the stack.
