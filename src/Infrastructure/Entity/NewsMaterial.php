<?php

namespace Pasha234\HwArchitecture\Infrastructure\Entity;

use Carbon\CarbonInterface;
use Doctrine\ORM\Mapping as ORM;
use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial as EntityNewsMaterial;
use Pasha234\HwArchitecture\Domain\ValueObject\Url;
use Pasha234\HwArchitecture\Infrastructure\Repository\PostgreNewsRepository; // For #[ORM\Entity(repositoryClass: ...)]

#[ORM\Entity(repositoryClass: PostgreNewsRepository::class)]
#[ORM\Table(name: 'news_materials')]
class NewsMaterial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id;

    #[ORM\Column(type: 'carbon_immutable', nullable: true)]
    public ?CarbonInterface $created_at = null;

    #[ORM\Column(type: 'string', length: 2048, nullable: true, name: 'url')]
    public ?string $url;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    public ?string $title;

    public function __construct(
        ?int $id,
        ?CarbonInterface $created_at,
        ?Url $url,
        ?string $title
    ) {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->url = $url->get();
        $this->title = $title;
    }

    public static function fromDomain(EntityNewsMaterial $domainNewsMaterial): NewsMaterial
    {
        return new NewsMaterial(
            $domainNewsMaterial->getId(),
            $domainNewsMaterial->getCreatedAt(),
            $domainNewsMaterial->getUrl(),
            $domainNewsMaterial->getTitle()
        );
    }
}