# braadiv/swagger-php

> **⚠️ This is a PHP 8.4 compatibility fork — NOT an original work.**

## Credits & Attribution

This package is a **modernized fork** of the original [`zircote/swagger-php`](https://github.com/zircote/swagger-php.git), created and maintained by **Robert Allen, Bob Fanger, and Martin Rademacher**.

**All original code, design, and intellectual property belong to the original author(s).**

The only modifications made in this fork are:
- Fixing PHP 8.4 deprecation warnings (`implicit nullable parameters` in `Analysis.php` and `Annotations\OpenApi.php`)
- Adding `#[\AllowDynamicProperties]` to `Context.php`
- Updating `composer.json` to support PHP 8.1–8.4 LTS
- Adding `"replace": {"zircote/swagger-php": "self.version"}` as a drop-in replacement
- Retaining 100% backward compatibility as a drop-in replacement

---

## Why this fork?

Legacy packages and Yii2 OpenAPI extensions (such as `genxoft/yii2-oas3`) rely on the 3.x series of `zircote/swagger-php`. Under PHP 8.4 LTS, implicit nullable parameters and dynamic properties trigger `E_DEPRECATED` warnings. This fork provides a **safe, drop-in replacement** under PHP 8.4.

---

## Installation

```bash
composer require braadiv/swagger-php
```

## Original Package Information

| | |
|:--|:--|
| **Original Package** | [`zircote/swagger-php`](https://github.com/zircote/swagger-php) |
| **Original Version** | `3.3.4` |
| **Original Authors** | Robert Allen, Bob Fanger, Martin Rademacher |
| **Original License** | `Apache-2.0` |
| **Fork Maintainer** | `braadiv` ([github.com/braadiv](https://github.com/braadiv)) |
| **PHP Compatibility** | `>=8.1 || ^8.2 || ^8.3 || ^8.4` |

---

## Changes from Original

See [CHANGELOG.md](../CHANGELOG.md) for a detailed list of all modifications.

---

## License

This fork retains the **same license** as the original package (`Apache-2.0`).
All rights and credits belong to the original authors.
