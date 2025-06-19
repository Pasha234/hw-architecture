<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Application\DTO\Entity\NewsMaterialCollectionMapper;
use Pasha234\HwArchitecture\Application\DTO\Request\GenerateReportRequestDto;
use Pasha234\HwArchitecture\Application\DTO\Response\GenerateReportResponseDto;
use Pasha234\HwArchitecture\Domain\Report\ReportGeneratorInterface;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class GenerateReport
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private ReportGeneratorInterface $reportGenerator,
    )
    {}

    public function execute(GenerateReportRequestDto $generateReportRequestDto): GenerateReportResponseDto
    {
        $news = $this->newsRepository->findByIds($generateReportRequestDto->getIds());
        $news = NewsMaterialCollectionMapper::toReportGeneratorInputDto($news);

        return new GenerateReportResponseDto(
            $this->reportGenerator->generate($news)->url
        );
    }
}