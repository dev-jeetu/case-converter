<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseConverterInterface;

class TitleCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        return str_replace('-', ' ', TrainCaseConverter::convert($string));
    }
}
