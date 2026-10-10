<?php

declare(strict_types=1);

use FastForward\DevTools\Config\ComposerDependencyAnalyserConfig;
use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return ComposerDependencyAnalyserConfig::configure(
    static function (Configuration $configuration): void {
        // This HTTP bundle deliberately provides these companion utilities to consumers.
        // See docs/links/dependencies.rst; the provider itself does not call them.
        $configuration->ignoreErrorsOnPackage('middlewares/utils', [ErrorType::UNUSED_DEPENDENCY]);
    },
);
