Dependencies
============

This page explains the packages that make ``fast-forward/http`` useful and how they relate to the
services exposed by ``HttpServiceProvider``.

Direct Dependencies
-------------------

.. list-table::
   :header-rows: 1
   :widths: 28 16 56

   * - Package
     - Constraint
     - Why it is required
   * - ``fast-forward/container``
     - ``^1.5``
     - Provides the container integration used to register and resolve the HTTP services
   * - ``fast-forward/http-client``
     - ``^1.0``
     - Registers the Symfony-backed PSR-18 client
   * - ``fast-forward/http-factory``
     - ``^1.1``
     - Registers PSR-17 factories, server request creation, and Fast Forward convenience factories
   * - ``middlewares/utils``
     - ``^4.0``
     - Adds common HTTP and middleware utility helpers to the dependency tree

Important Transitive Dependencies
---------------------------------

.. list-table::
   :header-rows: 1
   :widths: 28 16 56

   * - Package
     - Locked version
     - Why you will notice it
   * - ``fast-forward/http-message``
     - ``v1.4.0``
     - Provides the concrete response and stream classes created by the convenience factories
   * - ``nyholm/psr7``
     - ``1.8.2``
     - Provides the base PSR-7 implementation and the shared ``Psr17Factory``
   * - ``nyholm/psr7-server``
     - ``1.1.0``
     - Builds server requests from PHP globals
   * - ``symfony/http-client``
     - ``v7.4.8``
     - Powers the outbound HTTP client registered by the stack

Related Fast Forward Packages
-----------------------------

- `fast-forward/container <https://github.com/php-fast-forward/container>`_
- `fast-forward/http-client <https://github.com/php-fast-forward/http-client>`_
- `fast-forward/http-factory <https://github.com/php-fast-forward/http-factory>`_
- `fast-forward/http-message <https://github.com/php-fast-forward/http-message>`_
