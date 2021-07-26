dogado Cookie Manager for Laravel
===============

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
* php 7.3
* `symfony/http-foundation` version `^4.2` or `^5.0`

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
