<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Exceptions;

use InvalidArgumentException;

class UnsupportedFormatException extends InvalidArgumentException
{
    public function __construct(string $format, array $supportedFormats = [])
    {
        $message = "Unsupported format: '$format'";
        
        if (!empty($supportedFormats)) {
            $message .= '. Supported formats: ' . implode(', ', $supportedFormats);
        }
        
        parent::__construct($message);
    }
} 