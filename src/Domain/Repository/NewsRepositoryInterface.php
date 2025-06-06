<?php

namespace Pasha234\HwArchitecture\Domain\Repository;

use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Pasha234\HwArchitecture\Domain\Collection\NewsMaterialCollection;

interface NewsRepositoryInterface
{
    public function findByIds(array $ids): NewsMaterialCollection;

    public function save(NewsMaterial $newsMaterial): void;

    public function all(): NewsMaterialCollection;
}

