<?php

namespace Struzik\EPPClient\Extension\RGP;

use Struzik\EPPClient\Extension\ExtensionInterface;
use Struzik\EPPClient\Extension\RGP\Response\Addon\Info;
use Struzik\EPPClient\EPPClient;
use Struzik\EPPClient\Response\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Extension for the domain registry grace period.
 */
class RGPExtension implements ExtensionInterface
{
    const NS_NAME_RGP = 'rgp';

    /**
     * @var string
     */
    private $uri;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param string $uri URI of the RGP extension
     */
    public function __construct($uri, LoggerInterface $logger)
    {
        $this->uri = $uri;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function setupNamespaces(EPPClient $client)
    {
        $client->getExtNamespaceCollection()
            ->offsetSet(self::NS_NAME_RGP, $this->uri);
    }

    /**
     * {@inheritdoc}
     */
    public function handleResponse(ResponseInterface $response)
    {
        if (!in_array($this->uri, $response->getUsedNamespaces())) {
            $this->logger->debug(sprintf(
                'Namespace with URI \'%s\' does not exists in used namespaces in the response object.',
                $this->uri
            ));

            return;
        }

        $node = $response->getFirst('//rgp:rgpStatus');
        if ($node !== null) {
            $this->logger->debug(sprintf(
                'Adding add-on with class name \'%s\' to the response object.',
                Info::class
            ));
            $response->addExtAddon(new Info($response));
        }
    }
}
