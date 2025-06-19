<?php

namespace Pasha234\HwArchitecture\Domain\Report;

use Pasha234\HwArchitecture\Domain\DTO\ReportGenerator\InputDto;
use Pasha234\HwArchitecture\Domain\DTO\ReportGenerator\ResponseDto;

interface ReportGeneratorInterface
{
    /**
     * Generates a report from the given data in the specified format.
     *
     * @param array<int, InputDto> $data A collection of NewsMaterial objects.
     * @return ResponseDto Link on generated report
     * @throws \InvalidArgumentException if the format is unsupported.
     * @throws \RuntimeException if report generation fails.
     */
    public function generate(array $data): ResponseDto;
}