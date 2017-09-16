<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;

/**
 * Object representation of the <rgp:resReason> node.
 */
class ResReason extends AbstractNode
{
    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'rgp:resReason', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['reason'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'reason\'.');
        }

        $this->getNode()->nodeValue = $parameters['reason'];
    }
}
