Customization
=============

The default configuration is intentionally simple, but you can replace or narrow parts of the stack
when your application needs different defaults.

Use Only The Underlying Provider You Need
-----------------------------------------

If you only need factories, you can register the message factory provider directly instead of the
full aggregate provider:

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\Message\Factory\ServiceProvider\HttpMessageFactoryServiceProvider;
   use function FastForward\Container\container;

   $container = container(new HttpMessageFactoryServiceProvider());

If you need only the client provider, register ``HttpClientServiceProvider`` directly.

Override A Service With Your Own Provider
-----------------------------------------

The easiest way to replace one of the default services is to register your own provider *before*
``HttpServiceProvider``. The aggregate container resolves identifiers in registration order, so the
first matching provider wins.

.. code-block:: php

   <?php

   declare(strict_types=1);

   use FastForward\Http\ServiceProvider\HttpServiceProvider;
   use Interop\Container\ServiceProviderInterface;
   use Psr\Container\ContainerInterface;
   use Psr\Http\Client\ClientInterface;
   use Psr\Http\Message\ResponseFactoryInterface;
   use Psr\Http\Message\StreamFactoryInterface;
   use Symfony\Component\HttpClient\HttpClient;
   use Symfony\Component\HttpClient\Psr18Client;
   use function FastForward\Container\container;

   final class CustomHttpClientServiceProvider implements ServiceProviderInterface
   {
       public function getFactories(): array
       {
           return [
               HttpClient::class => static fn() => HttpClient::create([
                   'timeout' => 5.0,
               ]),
               ClientInterface::class => static fn(ContainerInterface $container) => new Psr18Client(
                   $container->get(HttpClient::class),
                   $container->get(ResponseFactoryInterface::class),
                   $container->get(StreamFactoryInterface::class),
               ),
           ];
       }

       public function getExtensions(): array
       {
           return [];
       }
   }

   $container = container(
       new CustomHttpClientServiceProvider(),
       new HttpServiceProvider(),
   );

What You Can Replace Safely
---------------------------

- ``Psr\Http\Client\ClientInterface`` if you want a different PSR-18 client
- ``Symfony\Component\HttpClient\HttpClient`` if you want different Symfony client defaults
- any PSR-17 factory interface if you need different object creation rules
- the Fast Forward convenience factory interfaces if you want different helper behavior

When Not To Customize
---------------------

Avoid replacing services just to reach the defaults. If the default behavior already matches your
needs, prefer the stock provider because it keeps application bootstrap code shorter and easier to
understand.
