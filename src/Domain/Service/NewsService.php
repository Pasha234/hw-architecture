<?php

namespace Pasha234\HwArchitecture\Domain\Service;

use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\Port\NewsHttpClient;
use Pasha234\HwArchitecture\Domain\Report\ReportGeneratorInterface;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class NewsService
{
    public function __construct(
        private NewsHttpClient $newsHttpClient,
        private NewsRepositoryInterface $newsRepository,
        private ReportGeneratorInterface $reportGenerator
    ) {}

    public function getTitleForNewsMaterial(NewsMaterial $newsMaterial): void
    {
        $newsMaterial->setTitle($this->newsHttpClient->getTitle(
            $newsMaterial->getUrl()
        ));
    }

    public function generateReport(array $ids): string
    {
        $newsItems = $this->newsRepository->findByIds($ids);
        return $this->reportGenerator->generate($newsItems);
    }
}