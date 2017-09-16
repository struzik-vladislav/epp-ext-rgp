<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Node\AbstractNode;
use Struzik\EPPClient\Request\RequestInterface;
use Struzik\EPPClient\Exception\InvalidArgumentException;
use Struzik\EPPClient\Exception\UnexpectedValueException;

/**
 * Object representation of the <rgp:restore> node.
 */
class Restore extends AbstractNode
{
    const OPERATION_REQUEST = 'request';
    const OPERATION_REPORT = 'report';

    /**
     * @param RequestInterface $request    The request object to which the node belongs
     * @param array            $parameters Array of parameters who will be passed in self::handleParameters
     */
    public function __construct(RequestInterface $request, $parameters = [])
    {
        parent::__construct($request, 'rgp:restore', $parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function handleParameters($parameters = [])
    {
        if (!isset($parameters['operation'])) {
            throw new InvalidArgumentException('Missing parameter with a key \'operation\'.');
        }

        if (!in_array($parameters['operation'], [self::OPERATION_REQUEST, self::OPERATION_REPORT])) {
            throw new UnexpectedValueException(sprintf(
                'The value of the parameter \'operation\' must be set to \'%s\' or \'%s\'.',
                self::OPERATION_REQUEST,
                self::OPERATION_REPORT
            ));
        }

        $this->getNode()->setAttribute('op', $parameters['operation']);
    }
}
