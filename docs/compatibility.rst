Compatibility
=============

This page summarizes the declared runtime requirements of the package and the versions currently
locked in this repository.

Runtime Matrix
--------------

.. list-table::
   :header-rows: 1
   :widths: 28 22 22 28

   * - Package
     - Declared constraint
     - Locked version
     - Notes
   * - ``php``
     - ``^8.3``
     - project platform ``8.3.0``
     - Required by this package
   * - ``fast-forward/container``
     - ``^1.5``
     - ``v1.6.0``
     - Container integration
   * - ``fast-forward/http-client``
     - ``^1.0``
     - ``v1.1.0``
     - PSR-18 client provider
   * - ``fast-forward/http-factory``
     - ``^1.1``
     - ``v1.2.0``
     - PSR-17 and convenience factories
   * - ``middlewares/utils``
     - ``^4.0``
     - ``v4.0.2``
     - HTTP and middleware utilities

Important Locked HTTP Stack Packages
------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 34 18 48

   * - Package
     - Locked version
     - Role
   * - ``fast-forward/http-message``
     - ``v1.4.0``
     - Concrete response and stream classes
   * - ``nyholm/psr7``
     - ``1.8.2``
     - PSR-7 implementation and PSR-17 factory
   * - ``nyholm/psr7-server``
     - ``1.1.0``
     - Server request creation from globals
   * - ``symfony/http-client``
     - ``v7.4.8``
     - Outbound HTTP transport used by the PSR-18 client

Compatibility Guidance
----------------------

- Type-hint PSR interfaces in your application code when possible.
- Treat the locked versions in this page as repository snapshots, not public API guarantees.
- Revisit this page when the Composer constraints or lock file change.
