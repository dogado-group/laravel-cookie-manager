dogado Cookie Manager for Laravel
===============

[![phpunit](https://github.com/dogado-group/laravel-cookie-manager/actions/workflows/phpunit.yml/badge.svg)](https://github.com/dogado-group/laravel-cookie-manager/actions/workflows/phpunit.yml)
[![Coverage Status](https://coveralls.io/repos/github/dogado-group/laravel-cookie-manager/badge.svg?branch=main)](https://coveralls.io/github/dogado-group/laravel-cookie-manager?branch=main)
[![Total Downloads](https://poser.pugx.org/dogado/laravel-cookie-manager/downloads)](https://packagist.org/packages/dogado/laravel-cookie-manager)
[![Latest Stable Version](https://poser.pugx.org/dogado/laravel-cookie-manager/v/stable)](https://packagist.org/packages/dogado/laravel-cookie-manager)
[![Latest Unstable Version](https://poser.pugx.org/dogado/laravel-cookie-manager/v/unstable.png)](https://packagist.org/packages/dogado/laravel-cookie-manager)
[![License](https://poser.pugx.org/dogado/laravel-cookie-manager/license)](https://packagist.org/packages/dogado/laravel-cookie-manager)

<!-- TOC -->

1. [Introduction](#introduction)
1. [Requirements](#requirements)
1. [Installation](#installation)
   - [Configure your Kernel to use the middleware](#configure-your-kernel-to-use-the-middleware)

<!-- /TOC -->

## Introduction

A client library package for Laravel based projects, maintained by the [dogado GmbH](https://dogado.de).

It provides a middleware class that automatically transforms cookies to be
[`Secure`](https://developer.mozilla.org/en-US/docs/Web/HTTP/Cookies#restrict_access_to_cookies) if the request is SSL
encrypted and, if the browser supports it, sets the
[`SameSite=None`](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie/SameSite) attribute.

To learn more about `SameSite` cookies and how to use them, check out the
[web.dev blog from Google](https://web.dev/samesite-cookies-explained/) or the
[Mozilla docs](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie/SameSite).

## Requirements
* php `^7.3` or `^8.0`
* `symfony/http-foundation` version `^5.3.7` or `^6.0`

## Installation

```
composer require dogado/laravel-cookie-manager
```

### Configure your Kernel to use the middleware

Add the following class to the appropriate Laravel kernel middleware configuration according to your requirements.
```
\Dogado\Laravel\CookieManager\Http\Middleware\SecureResponseCookies::class
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
