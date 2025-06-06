<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;
use Pasha234\HwArchitecture\Domain\Service\NewsService;

class AddNewsMaterial
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private NewsService $newsService
    )
    {}

    public function execute(string $url): int
    {
        $newsMaterial = NewsMaterial::fromUrl($url);
        $this->newsService->getTitleForNewsMaterial($newsMaterial);
        $this->newsRepository->save($newsMaterial);

        return $newsMaterial->getId();
    }
}