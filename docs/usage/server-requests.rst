Server Requests
===============

``HttpServiceProvider`` exposes the current incoming request as
``Psr\Http\Message\ServerRequestInterface``.

How It Is Built
---------------

The service comes from ``Nyholm\Psr7Server\ServerRequestCreator``. Internally, the provider calls
``fromGlobals()`` so the request is assembled from PHP superglobals such as ``$_SERVER``,
``$_GET``, ``$_POST``, ``$_COOKIE``, ``$_FILES``, and ``$_SERVER`` headers.

Basic Example
-------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use Psr\Http\Message\ServerRequestInterface;

   $request = $container->get(ServerRequestInterface::class);

   $method = $request->getMethod();
   $path = $request->getUri()->getPath();
   $query = $request->getQueryParams();
   $cookies = $request->getCookieParams();
   $uploadedFiles = $request->getUploadedFiles();

When To Request ServerRequestCreatorInterface Instead
-----------------------------------------------------

Request ``Nyholm\Psr7Server\ServerRequestCreatorInterface`` when you want to create the request
explicitly or you need more control over when the snapshot of globals is taken.

.. code-block:: php

   <?php

   declare(strict_types=1);

   use Nyholm\Psr7Server\ServerRequestCreatorInterface;

   $creator = $container->get(ServerRequestCreatorInterface::class);
   $request = $creator->fromGlobals();

Important Behavior
------------------

- The request is created lazily, not during container creation.
- The created request is cached by the container, so repeated calls return the same request object.
- If you change PHP superglobals after the request has already been resolved, the container will
  keep returning the original request instance.

Common Beginner Mistakes
------------------------

- In CLI scripts or background workers, PHP usually does not provide a real HTTP request context.
  In those cases, create a request manually with ``ServerRequestFactoryInterface``.
- Do not confuse ``ServerRequestInterface`` with ``RequestFactoryInterface``. One is an already
  built incoming request, while the other creates new outbound requests.
