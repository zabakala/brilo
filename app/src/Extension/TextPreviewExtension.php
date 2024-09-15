<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TextPreviewExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('preview', [$this, 'preview']),
        ];
    }

    public function preview(string $val, $maxLen = 80): string
    {
        return strlen($val) > $maxLen ? substr($val, 0, $maxLen) . '...' : $val;
    }
}
