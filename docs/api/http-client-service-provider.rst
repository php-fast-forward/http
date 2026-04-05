HttpClientServiceProvider
=========================

Class: ``FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider``

Purpose
-------

This provider registers the outbound HTTP client services used by the metapackage.

Key Services Registered
-----------------------

.. list-table::
   :header-rows: 1
   :widths: 34 34 32

   * - Identifier
     - Concrete service
     - Notes
   * - ``Symfony\Component\HttpClient\HttpClient``
     - Result of ``HttpClient::create()``
     - Lower-level Symfony client service
   * - ``Psr\Http\Client\ClientInterface``
     - ``Symfony\Component\HttpClient\Psr18Client``
     - Default PSR-18 client for application code

Dependencies
------------

The PSR-18 client depends on:

- the Symfony client service
- ``Psr\Http\Message\ResponseFactoryInterface``
- ``Psr\Http\Message\StreamFactoryInterface``

Those dependencies are why ``HttpClientServiceProvider`` pairs naturally with
``HttpMessageFactoryServiceProvider`` inside ``HttpServiceProvider``.

Extensions
----------

This provider does not register extensions by default.
