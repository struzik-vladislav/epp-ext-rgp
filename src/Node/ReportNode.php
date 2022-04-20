<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class ReportNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode): \DOMElement
    {
        $node = $request->getDocument()->createElement('rgp:report');
        $parentNode->appendChild($node);

        return $node;
    }
}
