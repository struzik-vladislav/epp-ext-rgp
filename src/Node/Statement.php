<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;

/**
 * Object representation of the <rgp:statement> node.
 */
class Statement extends AbstractNode
{
    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'rgp:statement', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['statement'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'statement\'.');
        }

        $this->getNode()->nodeValue = $parameters['statement'];

        if (isset($parameters['language']) && !empty($parameters['language'])) {
            $this->getNode()->setAttribute('lang', $parameters['language']);
        }
    }
}
