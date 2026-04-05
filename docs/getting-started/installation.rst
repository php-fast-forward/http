Installation
============

Requirements
------------

- PHP 8.3 or newer
- Composer

Install the package with Composer:

.. code-block:: bash

   composer require fast-forward/http

What Gets Installed
-------------------

This metapackage installs and coordinates the packages that make up the Fast Forward HTTP stack.

.. list-table::
   :header-rows: 1
   :widths: 28 22 50

   * - Package
     - Role
     - Why it matters
   * - ``fast-forward/container``
     - Container
     - Builds the PSR-11 container that will resolve the HTTP services
   * - ``fast-forward/http-factory``
     - Factory provider
     - Registers PSR-17 factories and Fast Forward convenience factories
   * - ``fast-forward/http-client``
     - Client provider
     - Registers the PSR-18 client service
   * - ``fast-forward/http-message``
     - Message classes
     - Provides concrete JSON, HTML, text, redirect, empty response, and JSON stream classes
   * - ``middlewares/utils``
     - Companion utility
     - Adds common HTTP and middleware utilities to the dependency tree

When To Use This Metapackage
----------------------------

Use ``fast-forward/http`` when:

- you want the full HTTP foundation installed in one step
- you want one provider class instead of registering multiple HTTP providers yourself
- you are starting a new project and want sensible defaults first

Prefer the individual packages when:

- you only need PSR-17 factories and do not need an HTTP client
- you want to control every HTTP dependency explicitly
- you are maintaining a minimal package with a very small runtime surface

What This Package Does Not Do
-----------------------------

This package does not provide a router, a middleware pipeline, or an HTTP response emitter by
itself. Its job is to install and register the HTTP primitives that those higher-level layers need.

Next Step
---------

Continue to :doc:`quickstart` for a minimal working example.
