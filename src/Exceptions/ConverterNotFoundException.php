<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Exceptions;

use RuntimeException;

class ConverterNotFoundException extends RuntimeException
{
    public function __construct(string $converterClass, string $format)
    {
        $message = "Converter class not found: '$converterClass' for format: '$format'";
        parent::__construct($message);
    }
} 