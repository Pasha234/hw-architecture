<?php

namespace Pasha234\HwArchitecture\Application\DTO\Response;

class AddNewsMaterialResponseDto
{
    public function __construct(
        private string $id
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}