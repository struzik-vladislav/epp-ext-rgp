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
use Struzik\EPPClient\Extension\RGP\Node\Other;
use Struzik\EPPClient\Extension\RGP\Node\Report;
use Struzik\EPPClient\Extension\RGP\Node\Restore;
use Struzik\EPPClient\Extension\RGP\Node\PreData;
use Struzik\EPPClient\Extension\RGP\Node\DelTime;
use Struzik\EPPClient\Extension\RGP\Node\ResTime;
use Struzik\EPPClient\Extension\RGP\Node\PostData;
use Struzik\EPPClient\Extension\RGP\Node\ResReason;
use Struzik\EPPClient\Extension\RGP\Node\Statement;

/**
 * Object representation of the request of the domain restore with operation 'report'.
 */
class RestoreReport extends AbstractRequest
{
    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $preData;

    /**
     * @var string
     */
    private $postData;

    /**
     * @var string
     */
    private $delTime;

    /**
     * @var string
     */
    private $resTime;

    /**
     * @var string
     */
    private $resReason;

    /**
     * @var string
     */
    private $firstStatement;

    /**
     * @var string
     */
    private $secondStatement;

    /**
     * @var string
     */
    private $other;

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

        $rgpRestore = new Restore($this, ['operation' => Restore::OPERATION_REPORT]);
        $rgpUpdate->append($rgpRestore);

        $rgpReport = new Report($this);
        $rgpRestore->append($rgpReport);

        $rgpPreData = new PreData($this, ['data' => $this->preData]);
        $rgpReport->append($rgpPreData);

        $rgpPostData = new PostData($this, ['data' => $this->postData]);
        $rgpReport->append($rgpPostData);

        $rgpDelTime = new DelTime($this, ['time' => $this->delTime]);
        $rgpReport->append($rgpDelTime);

        $rgpResTime = new ResTime($this, ['time' => $this->resTime]);
        $rgpReport->append($rgpResTime);

        $rgpResReason = new ResReason($this, ['reason' => $this->resReason]);
        $rgpResReason->append($rgpResReason);

        $rgpStatement = new Statement($this, ['statement' => $this->firstStatement]);
        $rgpReport->append($rgpStatement);

        $rgpStatement = new Statement($this, ['statement' => $this->secondStatement]);
        $rgpReport->append($rgpStatement);

        if ($this->other !== null) {
            $rgpOther = new Other($this, ['data' => $this->other]);
            $rgpReport->append($rgpOther);
        }

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

    /**
     * Setting a copy of the registration data that existed for the
     * domain name prior to the domain name being deleted. REQUIRED.
     *
     * @param string $preData registration data
     *
     * @return self
     */
    public function setPreData($preData)
    {
        $this->preData = $preData;

        return $this;
    }

    /**
     * Getting a copy of the registration data that existed for the
     * domain name prior to the domain name being deleted.
     *
     * @return string
     */
    public function getPreData()
    {
        return $this->preData;
    }

    /**
     * Setting a copy of the registration data that exists for the
     * domain name at the time the restore report is submitted. REQUIRED.
     *
     * @param string $postData registration data
     *
     * @return self
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;

        return $this;
    }

    /**
     * Getting a copy of the registration data that exists for the
     * domain name at the time the restore report is submitted.
     *
     * @return string
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * Setting the date and time when the domain name delete request
     * was sent to the server. REQUIRED.
     *
     * @param string $delTime formatted datetime string
     *
     * @return self
     */
    public function setDelTime($delTime)
    {
        $this->delTime = $delTime;

        return $this;
    }

    /**
     * Getting the date and time when the domain name delete request
     * was sent to the server.
     *
     * @return string
     */
    public function getDelTime()
    {
        return $this->delTime;
    }

    /**
     * Setting the date and time when the original <rgp:restore> command
     * was sent to the server. REQUIRED.
     *
     * @param string $resTime formatted datetime string
     *
     * @return self
     */
    public function setResTime($resTime)
    {
        $this->resTime = $resTime;

        return $this;
    }

    /**
     * Getting the date and time when the original <rgp:restore> command
     * was sent to the server.
     *
     * @return string
     */
    public function getResTime()
    {
        return $this->resTime;
    }

    /**
     * Setting a brief explanation of the reason for restoring the domain name.
     * REQUIRED.
     *
     * @param string $resReason reason for restoring
     *
     * @return self
     */
    public function setResReason($resReason)
    {
        $this->resReason = $resReason;

        return $this;
    }

    /**
     * Getting a brief explanation of the reason for restoring the domain name.
     *
     * @return string
     */
    public function getResReason()
    {
        return $this->resReason;
    }

    /**
     * Setting a text statement that the client has not restored
     * the domain name in order to assume the rights to use or sell
     * the domain name for itself or for any third party. REQUIRED.
     *
     * @param string $firstStatement text statement
     *
     * @return self
     */
    public function setFirstStatement($firstStatement)
    {
        $this->firstStatement = $firstStatement;

        return $this;
    }

    /**
     * Getting a text statement that the client has not restored
     * the domain name in order to assume the rights to use or sell
     * the domain name for itself or for any third party.
     *
     * @return string
     */
    public function getFirstStatement()
    {
        return $this->firstStatement;
    }

    /**
     * Setting a text statement that the information in the restore report
     * is factual to the best of the client's knowledge. REQUIRED.
     *
     * @param string $secondStatement text statement
     *
     * @return self
     */
    public function setSecondStatement($secondStatement)
    {
        $this->secondStatement = $secondStatement;

        return $this;
    }

    /**
     * Getting a text statement that the information in the restore report
     * is factual to the best of the client's knowledge.
     *
     * @return string
     */
    public function getSecondStatement()
    {
        return $this->secondStatement;
    }

    /**
     * Setting the information needed to support
     * the statements provided by the client. OPTIONAL.
     *
     * @param string|null $other text information
     *
     * @return self
     */
    public function setOther($other = null)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Getting the information needed to support
     * the statements provided by the client.
     *
     * @return string|null
     */
    public function getOther()
    {
        return $this->other;
    }
}
