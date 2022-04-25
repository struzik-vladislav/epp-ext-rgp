<?php

namespace Struzik\EPPClient\Extension\RGP\Tests;

use Psr\Log\NullLogger;
use Struzik\EPPClient\Extension\RGP\RGPExtension;
use Struzik\EPPClient\Tests\EPPTestCase;

class RGPTestCase extends EPPTestCase
{
    public RGPExtension $rgpExtension;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rgpExtension = new RGPExtension('urn:ietf:params:xml:ns:rgp-1.0', new NullLogger());
        $this->eppClient->pushExtension($this->rgpExtension);
    }
}
