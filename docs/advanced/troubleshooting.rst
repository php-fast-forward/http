Troubleshooting
===============

``ServerRequestInterface`` Looks Empty In CLI
---------------------------------------------

That is expected. The request is created from PHP globals. In CLI scripts, workers, or tests there
may be no real HTTP request context. Use ``ServerRequestFactoryInterface`` or
``ServerRequestCreatorInterface`` to build a request manually.

My Custom Service Is Ignored
---------------------------

Check provider order. If you want to override a default service, register your custom provider
before ``HttpServiceProvider``. The first provider that can resolve an identifier wins.

I Requested The Wrong ``ResponseFactoryInterface``
--------------------------------------------------

There are two similarly named interfaces in the stack:

- ``Psr\Http\Message\ResponseFactoryInterface`` for plain PSR-17 responses
- ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` for JSON, HTML, redirects, and other helpers

If you need convenience methods, request the Fast Forward interface.

JSON Response Creation Fails
----------------------------

Ensure your payload is JSON-encodable. Resources cannot be encoded to JSON and will fail when the
underlying ``JsonStream`` is created.

I Need Only One Part Of The Stack
---------------------------------

You do not need to keep the aggregate provider if you only want one feature. Use
``HttpMessageFactoryServiceProvider`` for factories only, or ``HttpClientServiceProvider`` for the
client only.
