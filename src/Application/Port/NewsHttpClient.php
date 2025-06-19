<?php

namespace Pasha234\HwArchitecture\Application\Port;

use Pasha234\HwArchitecture\Application\DTO\NewsHttpClient\GetTitleRequestDto;

interface NewsHttpClient
{
    public function getTitle(GetTitleRequestDto $getTitleRequestDto): string;
}