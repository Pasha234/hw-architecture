<?php

namespace Pasha234\HwArchitecture\Infrastructure\Report;

use Symfony\Component\Filesystem\Filesystem;
use Pasha234\HwArchitecture\Domain\Report\ReportGeneratorInterface;
use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;
use Pasha234\HwArchitecture\Domain\DTO\ReportGenerator\ResponseDto;
use Pasha234\HwArchitecture\Infrastructure\Service\UrlGeneratorService;

class HtmlReportGenerator implements ReportGeneratorInterface
{
    private Filesystem $filesystem;
    private string $publicReportsFilesystemPath;
    private string $publicReportsUrlPath;
    private UrlGeneratorService $urlGenerator;


    public function __construct(
        Filesystem $filesystem,
        string $publicReportsFilesystemPath,
        string $publicReportsUrlPath,
        UrlGeneratorService $urlGenerator
    )
    {
        $this->filesystem = $filesystem;
        $this->publicReportsFilesystemPath = $publicReportsFilesystemPath;
        $this->publicReportsUrlPath = $publicReportsUrlPath;
        $this->urlGenerator = $urlGenerator;
    }

    public function generate(array $news): ResponseDto
    {
        $reportContent = "<ul>\n";

        foreach ($news as $newsMaterial) {
            $reportContent .= "\t<li><a href=\"{$newsMaterial->getUrl()}\">{$newsMaterial->getTitle()}</a></li>\n";
        }

        $reportContent .= "</ul>";

        $fileName = 'report_' . uniqid() . '.html';
        $filePath = $this->publicReportsFilesystemPath . DIRECTORY_SEPARATOR . $fileName;

        $this->filesystem->dumpFile($filePath, $reportContent);

        $relativeUrl = rtrim($this->publicReportsUrlPath, '/') . '/' . ltrim($fileName, '/');
        
        return new ResponseDto(
            $this->urlGenerator->generateAbsoluteUrlForPath($relativeUrl)
        );
    }
}