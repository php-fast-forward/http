Quickstart
==========

The quickest way to use the package is to build a container with ``HttpServiceProvider`` and then
request the services you need by interface.

Minimal Example
---------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

   $responseFactory = $container->get(ResponseFactoryInterface::class);

   $response = $responseFactory->createResponseFromPayload([
       'message' => 'Hello, Fast Forward HTTP!',
       'ok' => true,
   ]);

   echo $response->getHeaderLine('Content-Type');
   // application/json; charset=utf-8

   echo (string) $response->getBody();
   // {"message":"Hello, Fast Forward HTTP!","ok":true}

Sending an Outbound HTTP Request
--------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

   $requestFactory = $container->get(RequestFactoryInterface::class);
   $client = $container->get(ClientInterface::class);

   $request = $requestFactory->createRequest('GET', 'https://example.com/health');
   $response = $client->sendRequest($request);

   echo $response->getStatusCode();
   // 200

What To Learn Next
------------------

- :doc:`../usage/getting-services` explains which services are registered
- :doc:`../usage/responses-and-streams` covers JSON, HTML, text, redirects, and payload streams
- :doc:`../usage/server-requests` explains how ``ServerRequestInterface`` is created from globals
