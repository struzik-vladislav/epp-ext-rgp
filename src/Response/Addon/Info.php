<?php

namespace Struzik\EPPClient\Extension\RGP\Response\Addon;

use Struzik\EPPClient\Response\ResponseInterface;

/**
 * Object representation of the add-on for domain information command.
 */
class Info
{
    const STATUS_ADD_PERIOD = 'addPeriod';
    const STATUS_AUTO_RENEW_PERIOD = 'autoRenewPeriod';
    const STATUS_RENEW_PERIOD = 'renewPeriod';
    const STATUS_TRANSFER_PERIOD = 'transferPeriod';
    const STATUS_PENDING_DELETE = 'pendingDelete';
    const STATUS_PENDING_RESTORE = 'pendingRestore';
    const STATUS_REDEMPTION_PERIOD = 'redemptionPeriod';

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Getting the current grace period status of the domain.
     *
     * @return string|null
     */
    public function getStatus()
    {
        $node = $this->response->getFirst('//epp:epp/epp:response/epp:extension/rgp:infData/rgp:rgpStatus');
        if ($node === null) {
            return null;
        }

        return $node->getAttribute('s');
    }
}
