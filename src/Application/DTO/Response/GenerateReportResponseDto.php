<?php

namespace Pasha234\HwArchitecture\Application\DTO\Response;

class GenerateReportResponseDto
{
    public function __construct(
        private string $url
    ) {}

    public function getUrl(): string
    {
        return $this->url;
    }
}