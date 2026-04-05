Use Cases
=========

This page shows practical scenarios that combine multiple services from the package.

Return a JSON Response From a Handler
-------------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;

   final readonly class HealthHandler
   {
       public function __construct(
           private ResponseFactoryInterface $responseFactory,
       ) {}

       public function __invoke(): \Psr\Http\Message\ResponseInterface
       {
           return $this->responseFactory->createResponseFromPayload([
               'status' => 'ok',
               'service' => 'http',
           ]);
       }
   }

Proxy a Remote HTTP Call
------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\RequestFactoryInterface;

   final readonly class WeatherProxy
   {
       public function __construct(
           private ClientInterface $client,
           private RequestFactoryInterface $requestFactory,
           private ResponseFactoryInterface $responseFactory,
       ) {}

       public function fetch(): \Psr\Http\Message\ResponseInterface
       {
           $request = $this->requestFactory->createRequest(
               'GET',
               'https://example.com/weather'
           );

           $upstream = $this->client->sendRequest($request);

           return $this->responseFactory->createResponseFromPayload([
               'status' => $upstream->getStatusCode(),
               'body' => (string) $upstream->getBody(),
           ]);
       }
   }

Read the Current Incoming Request
---------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use Psr\Http\Message\ServerRequestInterface;

   final readonly class RequestInspector
   {
       public function __construct(
           private ServerRequestInterface $request,
       ) {}

       public function path(): string
       {
           return $this->request->getUri()->getPath();
       }
   }

   // The injected request is created from PHP globals.

Return a Redirect After a Successful Action
-------------------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;

   final readonly class LoginHandler
   {
       public function __construct(
           private ResponseFactoryInterface $responseFactory,
       ) {}

       public function __invoke(): \Psr\Http\Message\ResponseInterface
       {
           return $this->responseFactory->createResponseRedirect('/dashboard');
       }
   }

Use Only Part of the Stack
--------------------------

You do not have to use the full metapackage behavior in every application. If you only need HTTP
factories, register ``HttpMessageFactoryServiceProvider`` directly. If you need the full stack,
keep using ``HttpServiceProvider`` as the single entry point.
