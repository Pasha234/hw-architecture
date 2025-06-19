<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Application\DTO\Response\GetNewsResponseDto;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class GetNews
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
    )
    {}

    /**
     * @return array<GetNewsResponseDto>
     */
    public function execute(): array
    {
        $news = $this->newsRepository->all();

        $newsDtos = [];
        foreach ($news as $newsMaterial) {
            $newsDtos[] = GetNewsResponseDto::fromDomain($newsMaterial);
        }

        return $newsDtos;
    }
}