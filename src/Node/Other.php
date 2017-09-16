<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;

/**
 * Object representation of the <rgp:other> node.
 */
class Other extends AbstractNode
{
    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'rgp:other', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['data'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'data\'.');
        }

        $this->getNode()->nodeValue = $parameters['data'];
    }
}
