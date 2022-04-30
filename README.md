# RGP Extension for EPP Client
![Build Status](https://github.com/struzik-vladislav/epp-ext-rgp/actions/workflows/ci.yml/badge.svg?branch=master)
[![Latest Stable Version](https://img.shields.io/github/v/release/struzik-vladislav/epp-ext-rgp?sort=semver&style=flat-square)](https://packagist.org/packages/struzik-vladislav/epp-ext-rgp)
[![Total Downloads](https://img.shields.io/packagist/dt/struzik-vladislav/epp-ext-rgp?style=flat-square)](https://packagist.org/packages/struzik-vladislav/epp-ext-rgp/stats)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)

Domain Registry Grace Period(RGP) extension for the EPP (Extensible Provisioning Protocol).

Implemented according to [RFC 3915](https://tools.ietf.org/html/rfc3915) Domain Registry Grace Period Mapping for the Extensible Provisioning Protocol (EPP).

Extension for [struzik-vladislav/epp-client](https://github.com/struzik-vladislav/epp-client) library.

## Usage
```php
<?php

use Struzik\EPPClient\Extension\RGP\RGPExtension;
use Struzik\EPPClient\Extension\RGP\Request\RGPRequestRestoreRequest;

// ...

$client->pushExtension(new RGPExtension('urn:ietf:params:xml:ns:rgp-1.0', $logger));

// ...

$request = new RGPRequestRestoreRequest($client);
$request->setDomain('example.net');
$response = $client->send($request);
```
