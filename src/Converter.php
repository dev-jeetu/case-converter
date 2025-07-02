<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

use DevJeetu\CaseConverter\DTOs\CaseFormatInfo;

class Converter
{
    public static function convert(string $input, CaseType|string $format): string
    {
        if (is_string($format)) {
            $format = CaseType::fromString($format);
        }

        return $format->convert($input);
    }

    public static function from(string $input): FluentConverter
    {
        return new FluentConverter($input);
    }

    public static function toCamel(string $input): string
    {
        return CaseType::CAMEL->convert($input);
    }

    public static function toPascal(string $input): string
    {
        return CaseType::PASCAL->convert($input);
    }

    public static function toSnake(string $input): string
    {
        return CaseType::SNAKE->convert($input);
    }

    public static function toKebab(string $input): string
    {
        return CaseType::KEBAB->convert($input);
    }

    public static function toMacro(string $input): string
    {
        return CaseType::MACRO->convert($input);
    }

    public static function toTrain(string $input): string
    {
        return CaseType::TRAIN->convert($input);
    }

    public static function toDot(string $input): string
    {
        return CaseType::DOT->convert($input);
    }

    public static function toLower(string $input): string
    {
        return CaseType::LOWER->convert($input);
    }

    public static function toUpper(string $input): string
    {
        return CaseType::UPPER->convert($input);
    }

    public static function toTitle(string $input): string
    {
        return CaseType::TITLE->convert($input);
    }

    public static function toPath(string $input): string
    {
        return CaseType::PATH->convert($input);
    }

    public static function toAda(string $input): string
    {
        return CaseType::ADA->convert($input);
    }

    public static function toCobol(string $input): string
    {
        return CaseType::COBOL->convert($input);
    }

    public static function toSentence(string $input): string
    {
        return CaseType::SENTENCE->convert($input);
    }

    public static function isFormatSupported(string $format): bool
    {
        return CaseType::isSupported($format);
    }

    /**
     * @return array<CaseType>
     */
    public static function getSupportedFormats(): array
    {
        return CaseType::cases();
    }

    /**
     * @return array<string>
     */
    public static function getSupportedFormatNames(): array
    {
        return CaseType::getSupportedNames();
    }

    /**
     * @return array<string>
     */
    public static function getSupportedAliases(): array
    {
        return CaseType::getAllAliases();
    }

    public static function getFormatInfo(CaseType|string $format): CaseFormatInfo
    {
        if (is_string($format)) {
            $format = CaseType::fromString($format);
        }

        return $format->getInfo();
    }

    /**
     * @return array<string, CaseFormatInfo>
     */
    public static function getAllFormatsInfo(): array
    {
        $info = [];
        foreach (CaseType::cases() as $format) {
            $info[$format->value] = $format->getInfo();
        }

        return $info;
    }

    public static function listFormats(): string
    {
        $output = "Supported Case Formats:\n";
        $output .= str_repeat("=", 50) . "\n\n";

        foreach (CaseType::cases() as $format) {
            $output .= sprintf(
                "%s %s\n%s\nExample: %s\nAliases: %s\n\n",
                $format->getEmoji(),
                $format->getDisplayName(),
                $format->getDescription(),
                $format->getExample(),
                implode(', ', array_slice($format->getAliases(), 0, 3))
            );
        }

        return $output;
    }
}
