<?php

namespace Pasha234\HwArchitecture\Domain\DTO\ReportGenerator;

class InputDto
{
    public function __construct(
        private string $url,
        private string $title,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}