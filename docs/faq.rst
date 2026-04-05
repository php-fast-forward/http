FAQ
===

What is ``fast-forward/http``?
------------------------------

It is the aggregate HTTP package of the Fast Forward ecosystem. It installs the HTTP client and
factory packages and exposes them through one provider, ``HttpServiceProvider``.

Do I need a framework to use it?
--------------------------------

No. The package is a library-level building block. You can use it in a small script, a custom
application bootstrap, or a larger framework-style architecture.

Which PHP version do I need?
----------------------------

You need PHP 8.3 or newer. See :doc:`compatibility`.

What is the difference between PSR-7, PSR-17, and PSR-18?
---------------------------------------------------------

PSR-7 defines HTTP message objects, PSR-17 defines factories that create those objects, and PSR-18
defines the client interface used to send requests. The overview on :doc:`index` introduces them in
plain language.

Why are there two ``ResponseFactoryInterface`` types?
-----------------------------------------------------

``Psr\Http\Message\ResponseFactoryInterface`` is the plain PSR-17 factory. 
``FastForward\Http\Message\Factory\ResponseFactoryInterface`` is the Fast Forward convenience
factory that adds helpers for JSON, HTML, text, redirects, and empty responses.

How do I get the current incoming request?
------------------------------------------

Request ``Psr\Http\Message\ServerRequestInterface`` from the container. It is created from PHP
globals. See :doc:`usage/server-requests`.

When should I use ``ServerRequestCreatorInterface`` instead?
------------------------------------------------------------

Use it when you want to control exactly when the request is built from globals, or when you need to
call ``fromGlobals()`` yourself in a more explicit bootstrap flow.

How do I send an outbound HTTP request?
---------------------------------------

Request ``Psr\Http\Client\ClientInterface`` and build a request with
``Psr\Http\Message\RequestFactoryInterface``. See :doc:`usage/http-client`.

How do I create JSON or redirect responses quickly?
---------------------------------------------------

Request ``FastForward\Http\Message\Factory\ResponseFactoryInterface`` and use
``createResponseFromPayload()`` or ``createResponseRedirect()``. See
:doc:`usage/responses-and-streams`.

Can I replace the default HTTP client or factories?
---------------------------------------------------

Yes. Register your own service provider before ``HttpServiceProvider`` so your identifiers are
resolved first. See :doc:`advanced/customization`.

Do I have to use the full metapackage?
--------------------------------------

No. You can register ``HttpMessageFactoryServiceProvider`` or ``HttpClientServiceProvider`` on
their own when you only need part of the stack.

Why does ``ServerRequestInterface`` look wrong in tests or CLI commands?
------------------------------------------------------------------------

Because it is built from PHP globals. In tests and CLI commands those globals may not represent a
real HTTP request. Build the request manually in those environments.
