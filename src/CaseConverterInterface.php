<?php

namespace DevJeetu\CaseConverter;

interface CaseConverterInterface
{
    public static function convert(string $string): string;
}
