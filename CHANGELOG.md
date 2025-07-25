# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

- `Added` for new features.
- `Changed` for changes in existing functionality.
- `Deprecated` for soon-to-be removed features.
- `Removed` for now removed features.
- `Fixed` for any bug fixes.
- `Security` in case of vulnerabilities

## [2.2.0] - 2025.07.22

### Added

- Added `exceptValues` and `getRandomItems` methods

## [2.1.0] - 2025.07.10

### Added

- Added `numericMultisort` and `ensureHas` methods

### Changed

- Updated documentation

## [2.0.2] - 2024.12.23

### Added

- Tested up to PHP v8.4.
- Updated GitHub issue templates.

## [2.0.1] - 2023.02.03

### Fixed

- Fixed depreciated bug in `query` method

## [2.0.0] - 2023.01.26

### Added

- Added support for PHP 8

## [1.3.1] - 2021.03.13

### Fixed

- Fixed bug in `multisort` method to preserve array order by adding the `SORT_NUMERIC` flag.

## [1.3.0] - 2021.02.17

### Added

- Added the `order` method.

## [1.2.0] - 2021.02.05

### Added

- Added the following methods:

    - `getAnyValues`
    - `hasAnyValues`
    - `hasAllValues`

## [1.1.0] - 2020.11.23

### Added

- Added `renameKeys` method.

## [1.0.1] - 2020.08.02

### Changed

- Corrected return type for `set()` as `void`

## [1.0.0] - 2020.07.27

### Added

- Initial release.