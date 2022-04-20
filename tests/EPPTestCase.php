<?php

namespace Struzik\EPPClient\Extension\RGP\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Struzik\EPPClient\Connection\ConnectionInterface;
use Struzik\EPPClient\EPPClient;
use Struzik\EPPClient\Extension\RGP\RGPExtension;
use Struzik\EPPClient\Extension\RGP\Tests\Connection\TestConnection;
use Struzik\EPPClient\Extension\RGP\Tests\IdGenerator\TestGenerator;
use Struzik\EPPClient\NamespaceCollection;

class EPPTestCase extends TestCase
{
    public ConnectionInterface $eppConnection;
    public EPPClient $eppClient;
    public RGPExtension $rgpExtension;

    protected function setUp(): void
    {
        parent::setUp();
        $this->eppConnection = new TestConnection();
        $this->eppClient = new EPPClient($this->eppConnection, new NullLogger());
        $this->eppClient->setIdGenerator(new TestGenerator());
        $namespaceCollection = $this->eppClient->getNamespaceCollection();
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_ROOT, 'urn:ietf:params:xml:ns:epp-1.0');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_CONTACT, 'urn:ietf:params:xml:ns:contact-1.0');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_HOST, 'urn:ietf:params:xml:ns:host-1.0');
        $namespaceCollection->offsetSet(NamespaceCollection::NS_NAME_DOMAIN, 'urn:ietf:params:xml:ns:domain-1.0');

        $this->rgpExtension = new RGPExtension('urn:ietf:params:xml:ns:rgp-1.0', new NullLogger());
        $this->eppClient->pushExtension($this->rgpExtension);
    }
}
