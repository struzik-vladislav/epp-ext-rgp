<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Request\RequestInterface;

class StatementNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode, string $statement, string $language = ''): \DOMElement
    {
        $node = $request->getDocument()->createElement('rgp:statement', $statement);
        $parentNode->appendChild($node);

        if ($language !== '') {
            $node->setAttribute('lang', $language);
        }

        return $node;
    }
}
