<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\UnexpectedValueException;
use Struzik\EPPClient\Extension\RGP\RGPExtension;

/**
 * Object representation of the <rgp:update> node.
 */
class Update extends AbstractNode
{
    /**
     * @param RequestInterface $request The request object to which the node belongs
     */
    public function __construct(RequestInterface $request)
    {
        parent::__construct($request, 'rgp:update');
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        $namespace = $this->getRequest()
            ->getClient()
            ->getExtNamespaceCollection()
            ->offsetGet(RGPExtension::NS_NAME_RGP);
        if (!$namespace) {
            throw new UnexpectedValueException('URI of the RGP namespace cannot be empty.');
        }

        $this->getNode()->setAttribute('xmlns:rgp', $namespace);
    }
}
