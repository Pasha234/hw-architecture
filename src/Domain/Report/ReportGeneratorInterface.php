<?php

namespace Pasha234\HwArchitecture\Domain\Report;

use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;

interface ReportGeneratorInterface
{
    /**
     * Generates a report from the given data in the specified format.
     *
     * @param NewsMaterialCollection $data A collection of NewsMaterial objects.
     * @return string Link on generated report
     * @throws \InvalidArgumentException if the format is unsupported.
     * @throws \RuntimeException if report generation fails.
     */
    public function generate(NewsMaterialCollection $data): string;
}