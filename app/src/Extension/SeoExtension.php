<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SeoExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('seo', [$this, 'seo']),
        ];
    }

    public function seo(string $val): string
    {
        return strtolower(str_replace(' ', '-', $val));
    }
}
