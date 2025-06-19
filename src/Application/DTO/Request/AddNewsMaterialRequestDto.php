<?php

namespace Pasha234\HwArchitecture\Application\DTO\Request;

class AddNewsMaterialRequestDto
{
    public function __construct(
        private string $url
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }
}