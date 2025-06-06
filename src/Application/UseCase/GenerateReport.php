<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Domain\Report\ReportGeneratorInterface;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class GenerateReport
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private ReportGeneratorInterface $reportGenerator,
    )
    {}

    public function execute(array $ids): string
    {
        $news = $this->newsRepository->findByIds($ids);
        return $this->reportGenerator->generate($news);
    }
}