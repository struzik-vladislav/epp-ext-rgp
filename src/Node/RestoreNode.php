<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Exception\InvalidArgumentException;
use Struzik\EPPClient\Exception\UnexpectedValueException;
use Struzik\EPPClient\Request\RequestInterface;

class RestoreNode
{
    public const OPERATION_REQUEST = 'request';
    public const OPERATION_REPORT = 'report';

    public static function create(RequestInterface $request, \DOMElement $parentNode, string $operation): \DOMElement
    {
        if ($operation === '') {
            throw new InvalidArgumentException('Invalid parameter "operation".');
        }
        if (!in_array($operation, [self::OPERATION_REQUEST, self::OPERATION_REPORT], true)) {
            throw new UnexpectedValueException(sprintf('The value of the parameter "operation" must be set to "%s" or "%s".', self::OPERATION_REQUEST, self::OPERATION_REPORT));
        }

        $node = $request->getDocument()->createElement('rgp:restore');
        $node->setAttribute('op', $operation);
        $parentNode->appendChild($node);

        return $node;
    }
}
