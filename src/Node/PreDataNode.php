<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class PreDataNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $data): \DOMElement
    {
        $node = $request->getDocument()->createElement('rgp:preData', $data);
        $parentNode->appendChild($node);

        return $node;
    }
}
