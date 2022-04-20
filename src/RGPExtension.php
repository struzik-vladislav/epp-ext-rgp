<?php

namespace Struzik\EPPClient\Extension\RGP;

use Psr\Log\LoggerInterface;
use Struzik\EPPClient\EPPClient;
use Struzik\EPPClient\Extension\ExtensionInterface;
use Struzik\EPPClient\Extension\RGP\Response\Addon\RGPInfo;
use Struzik\EPPClient\Response\ResponseInterface;

/**
 * Extension for the domain registry grace period.
 */
class RGPExtension implements ExtensionInterface
{
    public const NS_NAME_RGP = 'rgp';

    private string $uri;
    private LoggerInterface $logger;

    /**
     * @param string $uri URI of the RGP extension
     */
    public function __construct(string $uri, LoggerInterface $logger)
    {
        $this->uri = $uri;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function setupNamespaces(EPPClient $client): void
    {
        $client->getExtNamespaceCollection()
            ->offsetSet(self::NS_NAME_RGP, $this->uri);
    }

    /**
     * {@inheritdoc}
     */
    public function handleResponse(ResponseInterface $response): void
    {
        if (!in_array($this->uri, $response->getUsedNamespaces(), true)) {
            $this->logger->debug(sprintf(
                'Namespace with URI "%s" does not exists in used namespaces of the response object.',
                $this->uri
            ));

            return;
        }

        $node = $response->getFirst('//rgp:rgpStatus');
        if ($node !== null) {
            $this->logger->debug(sprintf('Adding add-on "%s" to the response object.', RGPInfo::class));
            $response->addExtAddon(new RGPInfo($response));
        }
    }
}
