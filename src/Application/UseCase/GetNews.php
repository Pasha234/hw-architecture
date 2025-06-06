<?php

namespace Pasha234\HwArchitecture\Application\UseCase;

use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;
use Pasha234\HwArchitecture\Domain\Repository\NewsRepositoryInterface;

class GetNews
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
    )
    {}

    public function execute(): NewsMaterialCollection
    {
        return $this->newsRepository->all();
    }
}