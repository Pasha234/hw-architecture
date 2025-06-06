<?php

namespace Pasha234\HwArchitecture\Domain\Port;

use Pasha234\HwArchitecture\Domain\ValueObject\Url;

interface NewsHttpClient
{
    public function getTitle(Url $url): string;
}