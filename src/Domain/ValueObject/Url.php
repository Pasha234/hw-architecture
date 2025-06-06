<?php

namespace Pasha234\HwArchitecture\Domain\ValueObject;

use InvalidArgumentException;

class Url
{
    private $url;

    public function __construct(string $url)
    {
        if (!$this->validate($url)) {
            throw new InvalidArgumentException('Invalid URL');
        }
        $this->url = $url;
    }

    private function validate(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public function get(): string
    {
        return $this->url;
    }
}