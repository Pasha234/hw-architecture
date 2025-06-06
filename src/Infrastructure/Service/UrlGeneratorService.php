<?php

namespace Pasha234\HwArchitecture\Infrastructure\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class UrlGeneratorService
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function generateAbsoluteUrlForPath(string $relativePath): ?string
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            return null;
        }

        return $request->getUriForPath($relativePath);
    }
}