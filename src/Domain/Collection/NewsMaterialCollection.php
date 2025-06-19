<?php

namespace Pasha234\HwArchitecture\Domain\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Pasha234\HwArchitecture\Domain\Entity\NewsMaterial;
use Traversable;
use InvalidArgumentException;

class NewsMaterialCollection implements IteratorAggregate, Countable
{
    /** @var NewsMaterial[] */
    private array $items = [];

    public function __construct(NewsMaterial ...$items)
    {
        $this->items = $items;
    }

    public static function fromArray(array $items): self
    {
        return new self(...$items);
    }

    public function add(NewsMaterial $newsMaterial): void
    {
        $this->items[] = $newsMaterial;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Returns the items as a plain array.
     * @return NewsMaterial[]
     */
    public function toArray(): array
    {
        return $this->items;
    }
}

