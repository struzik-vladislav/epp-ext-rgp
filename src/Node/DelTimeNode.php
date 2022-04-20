<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Exception\InvalidArgumentException;
use Struzik\EPPClient\Request\RequestInterface;

class DelTimeNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $time): \DOMElement
    {
        if ($time === '') {
            throw new InvalidArgumentException('Invalid parameter "time".');
        }

        $node = $request->getDocument()->createElement('rgp:delTime', $time);
        $parentNode->appendChild($node);

        return $node;
    }
}
