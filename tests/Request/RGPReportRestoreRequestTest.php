<?php

namespace Struzik\EPPClient\Extension\RGP\Tests\Request;

use Struzik\EPPClient\Extension\RGP\Request\RGPReportRestoreRequest;
use Struzik\EPPClient\Extension\RGP\Tests\RGPTestCase;

class RGPReportRestoreRequestTest extends RGPTestCase
{
    public function testReport(): void
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
        <rgp:restore op="report">
          <rgp:report>
            <rgp:preData>Pre-delete registration data goes here.</rgp:preData>
            <rgp:postData>Post-restore registration data goes here.</rgp:postData>
            <rgp:delTime>2003-07-10T22:00:00.0Z</rgp:delTime>
            <rgp:resTime>2003-07-20T22:00:00.0Z</rgp:resTime>
            <rgp:resReason>Registrant error.</rgp:resReason>
            <rgp:statement>This registrar has not restored the Registered Name in order to assume the rights to use or sell the Registered Name for itself or for any third party.</rgp:statement>
            <rgp:statement>The information in this report is true to best of this registrar's knowledge, and this registrar acknowledges that intentionally supplying false information in this report shall constitute an incurable material breach of the Registry-Registrar Agreement.</rgp:statement>
            <rgp:other>Supporting information goes here.</rgp:other>
          </rgp:report>
        </rgp:restore>
      </rgp:update>
    </extension>
    <clTRID>TEST-REQUEST-ID</clTRID>
  </command>
</epp>

EOF;
        $request = new RGPReportRestoreRequest($this->eppClient);
        $request->setDomain('example.com');
        $request->setPreData('Pre-delete registration data goes here.');
        $request->setPostData('Post-restore registration data goes here.');
        $request->setDelTime('2003-07-10T22:00:00.0Z');
        $request->setResTime('2003-07-20T22:00:00.0Z');
        $request->setResReason('Registrant error.');
        $request->setFirstStatement('This registrar has not restored the Registered Name in order to assume the rights to use or sell the Registered Name for itself or for any third party.');
        $request->setSecondStatement('The information in this report is true to best of this registrar\'s knowledge, and this registrar acknowledges that intentionally supplying false information in this report shall constitute an incurable material breach of the Registry-Registrar Agreement.');
        $request->setOther('Supporting information goes here.');
        $request->build();

        $this->assertSame($expected, $request->getDocument()->saveXML());
    }
}
