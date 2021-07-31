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
1. [Steps to configure](#steps-to-configure)
   - [Checkout](#checkout)
   - [Load Class into your config](#load-class-into-your-config)

<!-- /TOC -->

## Introduction

A client library package for Laravel based projects, maintained by the [dogado GmbH](https://dogado.de).

## Requirements
* php `^7.3` or `^8.0`
* `symfony/http-foundation` version `^4.4` or `^5.0`

## Steps to configure

### Checkout
Include this package into the project:
```
composer require dogado/laravel-cookie-manager
```

### Add the laravel middleware to your kernel
Add the following class according to your needs to the appropriate Laravel kernel middleware configuration.
```
\Dogado\Laravel\CookieManager\Http\Middleware\SecureResponseCookies::class
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
