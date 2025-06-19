<?php

namespace Pasha234\HwArchitecture\Application\DTO\NewsHttpClient;

class GetTitleRequestDto
{
    public function __construct(
        private string $url
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }
}