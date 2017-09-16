<?php

namespace Struzik\EPPClient\Extension\RGP\Request;

use Struzik\EPPClient\Request\AbstractRequest;
use Struzik\EPPClient\Response\Domain\Update as UpdateResponse;
use Struzik\EPPClient\Node\Common\Update as UpdateNode;
use Struzik\EPPClient\Node\Common\Command;
use Struzik\EPPClient\Node\Common\Extension;
use Struzik\EPPClient\Node\Common\TransactionId;
use Struzik\EPPClient\Node\Domain\Name;
use Struzik\EPPClient\Node\Domain\Update as DomainUpdateNode;
use Struzik\EPPClient\Node\Domain\Change;
use Struzik\EPPClient\Extension\RGP\Node\Update as RGPUpdateNode;
use Struzik\EPPClient\Extension\RGP\Node\Restore;

/**
 * Object representation of the request of the domain restore with operation 'request'.
 */
class RestoreRequest extends AbstractRequest
{
    /**
     * @var string
     */
    private $domain;

    /**
     * {@inheritdoc}
     */
    protected function handleParameters()
    {
        $epp = $this->getRoot();

        $command = new Command($this);
        $epp->append($command);

        $update = new UpdateNode($this);
        $command->append($update);

        $domainUpdate = new DomainUpdateNode($this);
        $update->append($domainUpdate);

        $domainName = new Name($this, ['domain' => $this->domain]);
        $domainUpdate->append($domainName);

        $domainChange = new Change($this);
        $domainUpdate->append($domainChange);

        $extension = new Extension($this);
        $command->append($extension);

        $rgpUpdate = new RGPUpdateNode($this);
        $extension->append($rgpUpdate);

        $rgpRestore = new Restore($this, ['operation' => Restore::OPERATION_REQUEST]);
        $rgpUpdate->append($rgpRestore);

        $transaction = new TransactionId($this);
        $command->append($transaction);
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseClass()
    {
        return UpdateResponse::class;
    }

    /**
     * Setting the name of the domain. REQUIRED.
     *
     * @param string $domain fully qualified name of the domain object
     *
     * @return self
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Getting the name of the domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }
}
