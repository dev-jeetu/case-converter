<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

use DevJeetu\CaseConverter\DTOs\CaseFormatInfo;

class CaseConverter
{
    public static function convert(string $input, CaseFormat|string $format): string
    {
        if (is_string($format)) {
            $format = CaseFormat::fromString($format);
        }

        return $format->convert($input);
    }

    public static function from(string $input): FluentCaseConverter
    {
        return new FluentCaseConverter($input);
    }

    public static function toCamel(string $input): string
    {
        return CaseFormat::CAMEL->convert($input);
    }

    public static function toPascal(string $input): string
    {
        return CaseFormat::PASCAL->convert($input);
    }

    public static function toSnake(string $input): string
    {
        return CaseFormat::SNAKE->convert($input);
    }

    public static function toKebab(string $input): string
    {
        return CaseFormat::KEBAB->convert($input);
    }

    public static function toMacro(string $input): string
    {
        return CaseFormat::MACRO->convert($input);
    }

    public static function toTrain(string $input): string
    {
        return CaseFormat::TRAIN->convert($input);
    }

    public static function toDot(string $input): string
    {
        return CaseFormat::DOT->convert($input);
    }

    public static function toLower(string $input): string
    {
        return CaseFormat::LOWER->convert($input);
    }

    public static function toUpper(string $input): string
    {
        return CaseFormat::UPPER->convert($input);
    }

    public static function toTitle(string $input): string
    {
        return CaseFormat::TITLE->convert($input);
    }

    public static function toPath(string $input): string
    {
        return CaseFormat::PATH->convert($input);
    }

    public static function toAda(string $input): string
    {
        return CaseFormat::ADA->convert($input);
    }

    public static function toCobol(string $input): string
    {
        return CaseFormat::COBOL->convert($input);
    }

    public static function toSentence(string $input): string
    {
        return CaseFormat::SENTENCE->convert($input);
    }

    public static function isFormatSupported(string $format): bool
    {
        return CaseFormat::isSupported($format);
    }

    /**
     * @return array<CaseFormat>
     */
    public static function getSupportedFormats(): array
    {
        return CaseFormat::cases();
    }

    /**
     * @return array<string>
     */
    public static function getSupportedFormatNames(): array
    {
        return CaseFormat::getSupportedNames();
    }

    /**
     * @return array<string>
     */
    public static function getSupportedAliases(): array
    {
        return CaseFormat::getAllAliases();
    }

    public static function getFormatInfo(CaseFormat|string $format): CaseFormatInfo
    {
        if (is_string($format)) {
            $format = CaseFormat::fromString($format);
        }

        return $format->getInfo();
    }

    /**
     * @return array<string, CaseFormatInfo>
     */
    public static function getAllFormatsInfo(): array
    {
        $info = [];
        foreach (CaseFormat::cases() as $format) {
            $info[$format->value] = $format->getInfo();
        }

        return $info;
    }

    public static function listFormats(): string
    {
        $output = "Supported Case Formats:\n";
        $output .= str_repeat("=", 50) . "\n\n";

        foreach (CaseFormat::cases() as $format) {
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
