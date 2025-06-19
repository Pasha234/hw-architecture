<?php

namespace Pasha234\HwArchitecture\Application\DTO\Response;

use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;

class GetNewsResponseDto
{
    public readonly ?int $id;
    public readonly ?string $title;
    public readonly ?string $url;
    public readonly ?string $createdAt;

    public function __construct(?int $id, ?string $title, ?string $url, ?string $createdAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
        $this->createdAt = $createdAt;
    }

    public static function fromDomain(NewsMaterial $newsMaterial): self
    {
        return new self(
            $newsMaterial->getId(),
            $newsMaterial->getTitle(),
            $newsMaterial->getUrl()?->get(),
            $newsMaterial->getCreatedAt()?->toIso8601String() // Format Carbon instance to string
        );
    }
}