Integration
===========

Fast Forward HTTP is designed to fit naturally into the Fast Forward container story, but the
package remains useful anywhere service providers and PSR-11 containers are part of the
application architecture.

Registering With The ``container()`` Helper
-------------------------------------------

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $container = container(new HttpServiceProvider());

This is the most direct and beginner-friendly setup.

Registering Through Configuration
---------------------------------

The Fast Forward container helper can also discover service providers from configuration.

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Config\ArrayConfig;
   use FastForward\Container\ContainerInterface;
   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $config = new ArrayConfig([
       ContainerInterface::class => [
           HttpServiceProvider::class,
       ],
   ]);

   $container = container($config);

This is useful when your application already centralizes provider registration in configuration.

Working Alongside Other Providers
---------------------------------

You can compose ``HttpServiceProvider`` with your own service providers or with providers from
other Fast Forward packages.

.. code-block:: php

   <?php

   declare(strict_types=1);

   use App\ServiceProvider\ApplicationServiceProvider;
   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use function FastForward\Container\container;

   $container = container(
       new ApplicationServiceProvider(),
       new HttpServiceProvider(),
   );

General Integration Guidance
----------------------------

- Use ``HttpServiceProvider`` when you want the full HTTP stack in one place.
- Use the underlying providers directly when you only want factories or only want the client.
- Keep your own services typed against PSR interfaces whenever possible.
- Move to :doc:`customization` when you need to override the default implementations.
