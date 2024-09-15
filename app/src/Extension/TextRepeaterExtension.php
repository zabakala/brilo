<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TextRepeaterExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('repeat', [$this, 'repeat']),
        ];
    }

    public function repeat(string $val, $times = 3): string
    {
        return str_repeat($val, $times);
    }
}
