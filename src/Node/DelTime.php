<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;

/**
 * Object representation of the <rgp:delTime> node.
 */
class DelTime extends AbstractNode
{
    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'rgp:delTime', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['time'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'time\'.');
        }

        $this->getNode()->nodeValue = $parameters['time'];
    }
}
