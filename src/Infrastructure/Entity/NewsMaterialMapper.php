<?php

namespace Pasha234\HwArchitecture\Infrastructure\Entity;

use Pasha234\HwArchitecture\Domain\ValueObject\Url;
use Pasha234\HwArchitecture\Infrastructure\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial as DomainNewsMaterial;

class NewsMaterialMapper
{
    public static function doctrineToDomain(NewsMaterial $newsMaterial): DomainNewsMaterial
    {
        return new DomainNewsMaterial(
            $newsMaterial->id,
            $newsMaterial->created_at,
            new Url($newsMaterial->url),
            $newsMaterial->title,
        );
    }
}