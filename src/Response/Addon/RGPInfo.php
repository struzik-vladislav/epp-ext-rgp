<?php

namespace Struzik\EPPClient\Extension\RGP\Response\Addon;

use Struzik\EPPClient\Response\ResponseInterface;

/**
 * Object representation of the add-on for domain information command.
 */
class RGPInfo
{
    public const STATUS_ADD_PERIOD = 'addPeriod';
    public const STATUS_AUTO_RENEW_PERIOD = 'autoRenewPeriod';
    public const STATUS_RENEW_PERIOD = 'renewPeriod';
    public const STATUS_TRANSFER_PERIOD = 'transferPeriod';
    public const STATUS_PENDING_DELETE = 'pendingDelete';
    public const STATUS_PENDING_RESTORE = 'pendingRestore';
    public const STATUS_REDEMPTION_PERIOD = 'redemptionPeriod';

    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Getting the current grace period status of the domain.
     */
    public function getStatus(): ?string
    {
        $node = $this->response->getFirst('//epp:epp/epp:response/epp:extension/rgp:upData/rgp:rgpStatus');
        if ($node === null) {
            return null;
        }

        return $node->getAttribute('s');
    }
}
