Quickstart
==========

After installation, you can immediately use the HTTP services provided by the FastForward ecosystem. The package aggregates and registers all necessary service providers for HTTP message creation and HTTP client usage.

Example usage:

.. code-block:: php

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use FastForward\Container\Container;

   $container = new Container([
       new HttpServiceProvider(),
   ]);

   // Now you can retrieve PSR-7/PSR-17/PSR-18 services from the container.
