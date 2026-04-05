FastForward HTTP
================

FastForward HTTP is the entry-point package for the HTTP stack of the Fast Forward ecosystem.
Instead of installing and wiring multiple HTTP packages by hand, you install one package and
register one service provider.

Once registered, the package exposes the building blocks that most HTTP applications need first:

- PSR-7 message objects
- PSR-17 factories for requests, responses, streams, URIs, and uploaded files
- A PSR-18 HTTP client
- Convenience factories for JSON, HTML, plain text, redirects, empty responses, and payload streams
- A ready-to-use ``ServerRequestInterface`` created from PHP globals

Who This Package Is For
-----------------------

Use ``fast-forward/http`` when you want a practical starting point for HTTP work in a Fast Forward
application or in any PSR-11 environment that can consume service providers.

If you only need a subset of the stack, such as factories without an HTTP client, you can use the
underlying packages directly. This documentation shows both approaches.

Understanding the Standards
---------------------------

.. list-table::
   :header-rows: 1
   :widths: 18 42 40

   * - Standard
     - What it means
     - What this package gives you
   * - PSR-7
     - Interfaces for HTTP requests, responses, URIs, uploaded files, and streams
     - Concrete PSR-7-compatible objects through the installed HTTP message stack
   * - PSR-17
     - Factory interfaces used to create PSR-7 objects
     - Registered factories such as ``RequestFactoryInterface`` and ``ResponseFactoryInterface``
   * - PSR-18
     - A standard HTTP client interface used to send PSR-7 requests
     - ``Psr\Http\Client\ClientInterface`` backed by Symfony HttpClient
   * - PSR-11
     - A standard interface for dependency injection containers
     - The package is consumed through a service provider and a container

Useful Links
------------

- `GitHub repository <https://github.com/php-fast-forward/http>`_
- `Packagist package <https://packagist.org/packages/fast-forward/http>`_
- `Issue tracker <https://github.com/php-fast-forward/http/issues>`_
- `Coverage report <https://php-fast-forward.github.io/http/coverage/index.html>`_
- `Testdox report <https://php-fast-forward.github.io/http/coverage/testdox.html>`_

.. toctree::
   :maxdepth: 2
   :caption: Contents:

   getting-started/index
   usage/index
   advanced/index
   api/index
   links/index
   faq
   compatibility
