HTTP Client
===========

The package registers a PSR-18 client under ``Psr\Http\Client\ClientInterface``. This is the
service you should use by default when you want to send outbound HTTP requests.

What Backs The Client
---------------------

The registered client is a ``Symfony\Component\HttpClient\Psr18Client`` built with:

- a Symfony HttpClient instance
- the PSR-17 response factory
- the PSR-17 stream factory

Basic Example
-------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $client = $container->get(ClientInterface::class);

   $request = $requestFactory->createRequest(
       'GET',
       'https://example.com/health'
   );

   $response = $client->sendRequest($request);

   echo $response->getStatusCode();
   echo (string) $response->getBody();

When To Use The Lower-Level Symfony Service
-------------------------------------------

The container also exposes ``Symfony\Component\HttpClient\HttpClient``. In most applications you
should continue to program against the PSR-18 interface, but the lower-level Symfony service can be
useful when you need framework-specific configuration or behavior.

Tips
----

- Use ``RequestFactoryInterface`` to build outbound requests instead of instantiating request
  objects manually.
- Keep your application code typed against ``ClientInterface`` so it stays easy to swap.
- If you need custom client defaults such as timeouts or base options, see
  :doc:`../advanced/customization`.
