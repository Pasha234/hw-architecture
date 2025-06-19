<?php

namespace Pasha234\HwArchitecture\Domain\Entity;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Pasha234\HwArchitecture\Domain\ValueObject\Url;

class NewsMaterial
{
    public function __construct(
        private ?int $id,
        private ?CarbonInterface $created_at,
        private ?Url $url,
        private ?string $title,
    ) {}

    public static function fromUrl(string $url): NewsMaterial
    {
        return new NewsMaterial(
            null,
            Carbon::now(),
            new Url($url),
            null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): CarbonInterface|null
    {
        return $this->created_at;
    }

    public function getUrl(): Url|null
    {
        return $this->url;
    }

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}