<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class ResReasonNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $reason): \DOMElement
    {
        $node = $request->getDocument()->createElement('rgp:resReason', $reason);
        $parentNode->appendChild($node);

        return $node;
    }
}
