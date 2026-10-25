# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.2] - 2026-10-25

### Changed

- GitHub Actions(deps): bump php-fast-forward/dev-tools/.github/workflows/wiki-direct.yml from c637e7f9d8ae6059b8655996e56f6d17f874792c to 84e154046e07cafa6ac09a9e12434b1ff5dcb5e0

  Update dependencies: `php-fast-forward/dev-tools/.github/workflows/wiki-direct.yml`.

  ([#11](https://github.com/php-fast-forward/http/pull/11), @dependabot[bot])

## [1.2.1] - 2026-10-25

### Changed

- Synchronize the bundled local skill automatically and trust Fast Forward Composer
  skill donors through `fast-forward/*`.
  Resolve Changelog contributor skills from stable `0.4.x` releases without a
  redundant skill allowlist.
  Load the project autoloader for PHPDoc checks when DevTools is installed as a
  dependency.

  ([#9](https://github.com/php-fast-forward/http/pull/9))

## [1.2.0] - 2026-10-21

### Added

- Bundle the fast-forward-http consumer skill with executable examples, optional installation guidance and Composer discovery metadata. ([#7](https://github.com/php-fast-forward/http/pull/7))
- Restores the Fast Forward Container consumer skill through the existing development-only Composer skill manager, alongside the configured contributor skills, without changing runtime dependencies. ([#6](https://github.com/php-fast-forward/http/pull/6))

### Changed

- Automate changelog checks, PR feedback and reviewed releases with Fast Forward Changelog, including the project agent skill. ([#6](https://github.com/php-fast-forward/http/pull/6))
- Synchronize the Config and Container consumer skills from the installed Composer dependencies through an explicit trusted-package list instead of independent GitHub sources. ([#6](https://github.com/php-fast-forward/http/pull/6))
- Restore the Changelog contributor skill through the development-only Composer skill manager and its reviewed GitHub source instead of versioning generated skill copies. ([#6](https://github.com/php-fast-forward/http/pull/6))
- Require fast-forward/container ^1.10 so installed Composer dependencies supply the supported Container consumer skill alongside the runtime library. ([#6](https://github.com/php-fast-forward/http/pull/6))

## [1.1.0] - 2026-03-29

**Full Changelog**: https://github.com/php-fast-forward/http/compare/v1.0.1...v1.1.0

## [1.0.1] - 2025-08-01

Release notes are unavailable for this version.

## [1.0.0] - 2025-08-01

Release notes are unavailable for this version.

## [0.1.0] - 2025-08-01

Release notes are unavailable for this version.

[1.2.2]: https://github.com/php-fast-forward/http/compare/v1.2.1...v1.2.2
[1.2.1]: https://github.com/php-fast-forward/http/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/php-fast-forward/http/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/php-fast-forward/http/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/php-fast-forward/http/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/php-fast-forward/http/compare/v0.1.0...v1.0.0
[0.1.0]: https://github.com/php-fast-forward/http/releases/tag/v0.1.0
