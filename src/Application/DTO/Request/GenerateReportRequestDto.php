<?php

namespace Pasha234\HwArchitecture\Application\DTO\Request;

class GenerateReportRequestDto
{
    public function __construct(
        private array $ids
    ) {}

    public function getIds(): array
    {
        return $this->ids;
    }
}