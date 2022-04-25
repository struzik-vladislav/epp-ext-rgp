# RGP Extension for EPP Client

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
