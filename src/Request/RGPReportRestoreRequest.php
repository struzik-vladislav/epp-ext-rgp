<?php

namespace Struzik\EPPClient\Extension\RGP\Request;

use Struzik\EPPClient\Extension\RGP\Node\DelTimeNode;
use Struzik\EPPClient\Extension\RGP\Node\OtherNode;
use Struzik\EPPClient\Extension\RGP\Node\PostDataNode;
use Struzik\EPPClient\Extension\RGP\Node\PreDataNode;
use Struzik\EPPClient\Extension\RGP\Node\ReportNode;
use Struzik\EPPClient\Extension\RGP\Node\ResReasonNode;
use Struzik\EPPClient\Extension\RGP\Node\ResTimeNode;
use Struzik\EPPClient\Extension\RGP\Node\RestoreNode;
use Struzik\EPPClient\Extension\RGP\Node\RGPUpdateNode;
use Struzik\EPPClient\Extension\RGP\Node\StatementNode;
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
 * Object representation of the request of the domain restore with operation 'report'.
 */
class RGPReportRestoreRequest extends AbstractRequest
{
    private string $domain = '';
    private string $preData = '';
    private string $postData = '';
    private string $delTime = '';
    private string $resTime = '';
    private string $resReason = '';
    private string $firstStatement = '';
    private string $secondStatement = '';
    private ?string $other = null;

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
        $rgpRestoreNode = RestoreNode::create($this, $rgpUpdateNode, RestoreNode::OPERATION_REPORT);
        $rgpReportNode = ReportNode::create($this, $rgpRestoreNode);
        PreDataNode::create($this, $rgpReportNode, $this->preData);
        PostDataNode::create($this, $rgpReportNode, $this->postData);
        DelTimeNode::create($this, $rgpReportNode, $this->delTime);
        ResTimeNode::create($this, $rgpReportNode, $this->resTime);
        ResReasonNode::create($this, $rgpReportNode, $this->resReason);
        StatementNode::create($this, $rgpReportNode, $this->firstStatement);
        StatementNode::create($this, $rgpReportNode, $this->secondStatement);
        if ($this->other !== null) {
            OtherNode::create($this, $rgpReportNode, $this->other);
        }
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

    /**
     * Setting a copy of the registration data that existed for the
     * domain name prior to the domain name being deleted. REQUIRED.
     *
     * @param string $preData registration data
     */
    public function setPreData(string $preData): self
    {
        $this->preData = $preData;

        return $this;
    }

    /**
     * Getting a copy of the registration data that existed for the
     * domain name prior to the domain name being deleted.
     */
    public function getPreData(): string
    {
        return $this->preData;
    }

    /**
     * Setting a copy of the registration data that exists for the
     * domain name at the time the restore report is submitted. REQUIRED.
     *
     * @param string $postData registration data
     */
    public function setPostData(string $postData): self
    {
        $this->postData = $postData;

        return $this;
    }

    /**
     * Getting a copy of the registration data that exists for the
     * domain name at the time the restore report is submitted.
     */
    public function getPostData(): string
    {
        return $this->postData;
    }

    /**
     * Setting the date and time when the domain name delete request
     * was sent to the server. REQUIRED.
     *
     * @param string $delTime formatted datetime string
     */
    public function setDelTime(string $delTime): self
    {
        $this->delTime = $delTime;

        return $this;
    }

    /**
     * Getting the date and time when the domain name delete request
     * was sent to the server.
     */
    public function getDelTime(): string
    {
        return $this->delTime;
    }

    /**
     * Setting the date and time when the original <rgp:restore> command
     * was sent to the server. REQUIRED.
     *
     * @param string $resTime formatted datetime string
     */
    public function setResTime(string $resTime): self
    {
        $this->resTime = $resTime;

        return $this;
    }

    /**
     * Getting the date and time when the original <rgp:restore> command
     * was sent to the server.
     */
    public function getResTime(): string
    {
        return $this->resTime;
    }

    /**
     * Setting a brief explanation of the reason for restoring the domain name.
     * REQUIRED.
     *
     * @param string $resReason reason for restoring
     */
    public function setResReason(string $resReason): self
    {
        $this->resReason = $resReason;

        return $this;
    }

    /**
     * Getting a brief explanation of the reason for restoring the domain name.
     */
    public function getResReason(): string
    {
        return $this->resReason;
    }

    /**
     * Setting a text statement that the client has not restored
     * the domain name in order to assume the rights to use or sell
     * the domain name for itself or for any third party. REQUIRED.
     *
     * @param string $firstStatement text statement
     */
    public function setFirstStatement(string $firstStatement): self
    {
        $this->firstStatement = $firstStatement;

        return $this;
    }

    /**
     * Getting a text statement that the client has not restored
     * the domain name in order to assume the rights to use or sell
     * the domain name for itself or for any third party.
     */
    public function getFirstStatement(): string
    {
        return $this->firstStatement;
    }

    /**
     * Setting a text statement that the information in the restore report
     * is factual to the best of the client's knowledge. REQUIRED.
     *
     * @param string $secondStatement text statement
     */
    public function setSecondStatement(string $secondStatement): self
    {
        $this->secondStatement = $secondStatement;

        return $this;
    }

    /**
     * Getting a text statement that the information in the restore report
     * is factual to the best of the client's knowledge.
     */
    public function getSecondStatement(): string
    {
        return $this->secondStatement;
    }

    /**
     * Setting the information needed to support
     * the statements provided by the client. OPTIONAL.
     *
     * @param string|null $other text information
     */
    public function setOther(?string $other = null): self
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Getting the information needed to support
     * the statements provided by the client.
     */
    public function getOther(): ?string
    {
        return $this->other;
    }
}
