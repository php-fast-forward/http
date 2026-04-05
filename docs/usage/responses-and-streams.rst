Responses and Streams
=====================

The most beginner-friendly feature in this package is the Fast Forward response factory. It builds
on top of PSR-17 and gives you ready-made helpers for the response types developers use every day.

Request the Convenience Factories
---------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use FastForward\Http\Message\Factory\StreamFactoryInterface;

   $responseFactory = $container->get(ResponseFactoryInterface::class);
   $streamFactory = $container->get(StreamFactoryInterface::class);

Response Helper Methods
-----------------------

.. list-table::
   :header-rows: 1
   :widths: 38 22 40

   * - Method
     - Returns
     - Use when
   * - ``createResponseFromHtml(string $html)``
     - ``HtmlResponse``
     - You want to return rendered HTML
   * - ``createResponseFromText(string $text)``
     - ``TextResponse``
     - You want a plain-text response such as ``pong`` or diagnostics
   * - ``createResponseFromPayload(array $payload)``
     - ``JsonResponse``
     - You want a JSON response from an array payload
   * - ``createResponseNoContent(array $headers = [])``
     - ``EmptyResponse``
     - You want an HTTP 204 response
   * - ``createResponseRedirect(string|UriInterface $uri, bool $permanent = false, array $headers = [])``
     - ``RedirectResponse``
     - You want a 302 or 301 redirect
   * - ``createStreamFromPayload(array $payload)``
     - ``JsonStream``
     - You want a stream containing JSON and still keep access to the original payload

Examples
--------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ResponseFactoryInterface;
   use FastForward\Http\Message\Factory\StreamFactoryInterface;

   $responseFactory = $container->get(ResponseFactoryInterface::class);
   $streamFactory = $container->get(StreamFactoryInterface::class);

   $html = $responseFactory->createResponseFromHtml('<h1>Hello</h1>');
   $text = $responseFactory->createResponseFromText('pong');
   $json = $responseFactory->createResponseFromPayload(['ok' => true]);
   $empty = $responseFactory->createResponseNoContent();
   $redirect = $responseFactory->createResponseRedirect('/login');
   $permanentRedirect = $responseFactory->createResponseRedirect('/docs', true);

   $payloadStream = $streamFactory->createStreamFromPayload([
       'items' => [1, 2, 3],
   ]);

Why The Fast Forward Factories Are Useful
-----------------------------------------

- They create the correct HTTP status and content-type headers for common response types.
- They keep your application code shorter and easier to read.
- They return PSR-7-compatible responses, so you can still pass them anywhere a normal response is
  expected.
- JSON responses and streams keep access to the original payload through payload-aware interfaces.

Gotchas
-------

- ``createResponseFromPayload()`` and ``createStreamFromPayload()`` expect JSON-encodable data.
  Resources cannot be encoded to JSON and will fail.
- ``createResponseNoContent()`` returns HTTP 204, so you should not expect a body there.
- Redirects are temporary by default. Pass ``true`` as the second argument to generate a permanent
  redirect.
- All returned responses remain immutable, following PSR-7 semantics.
