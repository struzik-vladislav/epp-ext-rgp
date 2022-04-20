<?php

namespace Struzik\EPPClient\Extension\RGP\Tests\Request;

use Struzik\EPPClient\Extension\RGP\Request\RGPRequestRestoreRequest;
use Struzik\EPPClient\Extension\RGP\Tests\EPPTestCase;

class RGPRequestRestoreRequestTest extends EPPTestCase
{
    public function testRequest(): void
    {
        $expected = <<<'EOF'
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <command>
    <update>
      <domain:update xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
        <domain:name>example.com</domain:name>
        <domain:chg/>
      </domain:update>
    </update>
    <extension>
      <rgp:update xmlns:rgp="urn:ietf:params:xml:ns:rgp-1.0">
        <rgp:restore op="request"/>
      </rgp:update>
    </extension>
    <clTRID>TEST-REQUEST-ID</clTRID>
  </command>
</epp>

EOF;
        $request = new RGPRequestRestoreRequest($this->eppClient);
        $request->setDomain('example.com');
        $request->build();

        $this->assertSame($expected, $request->getDocument()->saveXML());
    }
}
