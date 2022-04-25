<?php

namespace Struzik\EPPClient\Extension\RGP\Tests\Response\Addon;

use Struzik\EPPClient\Extension\RGP\Response\Addon\RGPInfo;
use Struzik\EPPClient\Extension\RGP\Tests\RGPTestCase;
use Struzik\EPPClient\Response\Domain\UpdateDomainResponse;

class RGPInfoTest extends RGPTestCase
{
    public function testAddon(): void
    {
        $xml = <<<'EOF'
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
  <response>
    <result code="1000">
      <msg lang="en">Command completed successfully</msg>
    </result>
    <extension>
      <rgp:upData xmlns:rgp="urn:ietf:params:xml:ns:rgp-1.0">
        <rgp:rgpStatus s="pendingRestore"/>
      </rgp:upData>
    </extension>
    <trID>
      <clTRID>ABC-12345</clTRID>
      <svTRID>54321-XYZ</svTRID>
    </trID>
  </response>
</epp>
EOF;
        $response = new UpdateDomainResponse($xml);
        $this->rgpExtension->handleResponse($response);
        $this->assertTrue($response->isSuccess());
        $this->assertInstanceOf(RGPInfo::class, $response->findExtAddon(RGPInfo::class));

        /** @var RGPInfo $rgpInfo */
        $rgpInfo = $response->findExtAddon(RGPInfo::class);
        $this->assertSame(RGPInfo::STATUS_PENDING_RESTORE, $rgpInfo->getStatus());
    }
}
