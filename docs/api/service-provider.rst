HttpServiceProvider
===================

Class: ``FastForward\Http\ServiceProvider\HttpServiceProvider``

Purpose
-------

``HttpServiceProvider`` is the single entry point of this package. It extends
``FastForward\Container\ServiceProvider\AggregateServiceProvider`` and aggregates the two providers
that make up the default HTTP stack:

- ``FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider``
- ``FastForward\Http\Client\ServiceProvider\HttpClientServiceProvider``

What The Constructor Does
-------------------------

``__construct()`` creates the aggregate provider with the default HTTP message factory provider and
the default HTTP client provider.

Why This Matters
----------------

- You register one provider instead of wiring the HTTP stack manually.
- All factories from both underlying providers are merged into a single provider.
- The aggregate provider also registers itself and its child providers under their class names.

Typical Usage
-------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

See Also
--------

- :doc:`http-message-factory-service-provider`
- :doc:`http-client-service-provider`
- :doc:`aggregated-services`
