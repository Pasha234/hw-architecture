<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Application\DTO\NewsHttpClient\GetTitleRequestDto;
use Pasha234\HwArchitecture\Application\DTO\Request\AddNewsMaterialRequestDto;
use Pasha234\HwArchitecture\Application\DTO\Response\AddNewsMaterialResponseDto;
use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Application\Port\NewsHttpClient;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class AddNewsMaterial
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private NewsHttpClient $newsHttpClient,
    )
    {}

    public function execute(AddNewsMaterialRequestDto $addNewsMaterialRequestDto): AddNewsMaterialResponseDto
    {
        $newsMaterial = NewsMaterial::fromUrl($addNewsMaterialRequestDto->getUrl());
        $newsMaterial->setTitle($this->newsHttpClient->getTitle(
            new GetTitleRequestDto($newsMaterial->getUrl()->get())
        ));
        $this->newsRepository->save($newsMaterial);

        return new AddNewsMaterialResponseDto(
            $newsMaterial->getId()
        );
    }
}