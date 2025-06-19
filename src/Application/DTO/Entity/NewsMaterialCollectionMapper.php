<?php

namespace Pasha234\HwArchitecture\Application\DTO\Entity;

use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\DTO\ReportGenerator\InputDto;
use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;

class NewsMaterialCollectionMapper
{
    public static function toReportGeneratorInputDto(NewsMaterialCollection $newsMaterialCollection): array
    {
        $newsMaterialCollection = $newsMaterialCollection->toArray();

        return array_map(function(NewsMaterial $newsMaterial) {
            return new InputDto(
                $newsMaterial->getUrl()->get(),
                $newsMaterial->getTitle()
            );
        }, $newsMaterialCollection);
    }
}