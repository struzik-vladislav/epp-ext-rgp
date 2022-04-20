<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class OtherNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $data): \DOMElement
    {
        $node = $request->getDocument()->createElement('rgp:other', $data);
        $parentNode->appendChild($node);

        return $node;
    }
}
