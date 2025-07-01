<?php

namespace DevJeetu\CaseConverter\DTOs;

class CaseFormatInfo
{
    public function __construct(
        public string $name,
        public string $emoji,
        public string $description,
        public string $example,
        public string $delimiter,
        /**
         * @var array<string>
         */
        public array $aliases,
        public string $converterClass,
        public bool $isCapitalized,
        public bool $isUppercase,
        public bool $isLowercase
    ) {
    }
}
