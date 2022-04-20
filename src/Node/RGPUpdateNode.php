<?php

namespace Struzik\EPPClient\Extension\RGP\Node;

use Struzik\EPPClient\Exception\UnexpectedValueException;
use Struzik\EPPClient\Extension\RGP\RGPExtension;
use Struzik\EPPClient\Request\RequestInterface;

class RGPUpdateNode
{
    public static function create(RequestInterface $request, \DOMElement $parentNode): \DOMElement
    {
        $namespace = $request->getClient()
            ->getExtNamespaceCollection()
            ->offsetGet(RGPExtension::NS_NAME_RGP);
        if (!$namespace) {
            throw new UnexpectedValueException('URI of the RGP namespace cannot be empty.');
        }

        $node = $request->getDocument()->createElement('rgp:update');
        $node->setAttribute('xmlns:rgp', $namespace);
        $parentNode->appendChild($node);

        return $node;
    }
}
