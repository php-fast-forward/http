Getting Services
===============

After registering the `HttpServiceProvider` in your container, you can retrieve any PSR-7, PSR-17, or PSR-18 service from the container. Example:

.. code-block:: php

   $responseFactory = $container->get(Psr\Http\Message\ResponseFactoryInterface::class);
   $client = $container->get(Psr\Http\Client\ClientInterface::class);
