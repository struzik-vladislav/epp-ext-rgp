<?php

namespace Struzik\EPPClient\Extension\RGP\Request;

use Struzik\EPPClient\Extension\RGP\Node\RestoreNode;
use Struzik\EPPClient\Extension\RGP\Node\RGPUpdateNode;
use Struzik\EPPClient\Node\Common\CommandNode;
use Struzik\EPPClient\Node\Common\EppNode;
use Struzik\EPPClient\Node\Common\ExtensionNode;
use Struzik\EPPClient\Node\Common\TransactionIdNode;
use Struzik\EPPClient\Node\Common\UpdateNode;
use Struzik\EPPClient\Node\Domain\DomainChangeNode;
use Struzik\EPPClient\Node\Domain\DomainNameNode;
use Struzik\EPPClient\Node\Domain\DomainUpdateNode;
use Struzik\EPPClient\Request\AbstractRequest;
use Struzik\EPPClient\Response\Domain\UpdateDomainResponse;

/**
 * Object representation of the request of the domain restore with operation 'request'.
 */
class RGPRequestRestoreRequest extends AbstractRequest
{
    private string $domain = '';

    /**
     * {@inheritdoc}
     */
    protected function handleParameters(): void
    {
        $eppNode = EppNode::create($this);
        $commandNode = CommandNode::create($this, $eppNode);
        $updateNode = UpdateNode::create($this, $commandNode);
        $domainUpdateNode = DomainUpdateNode::create($this, $updateNode);
        DomainNameNode::create($this, $domainUpdateNode, $this->domain);
        DomainChangeNode::create($this, $domainUpdateNode);
        $extensionNode = ExtensionNode::create($this);
        $rgpUpdateNode = RGPUpdateNode::create($this, $extensionNode);
        RestoreNode::create($this, $rgpUpdateNode, RestoreNode::OPERATION_REQUEST);
        TransactionIdNode::create($this, $commandNode);
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseClass(): string
    {
        return UpdateDomainResponse::class;
    }

    /**
     * Setting the name of the domain. REQUIRED.
     *
     * @param string $domain fully qualified name of the domain object
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Getting the name of the domain.
     */
    public function getDomain(): string
    {
        return $this->domain;
    }
}
