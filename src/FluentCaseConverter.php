<?php

namespace DevJeetu\CaseConverter;

readonly class FluentCaseConverter
{
    public function __construct(private string $input)
    {
    }

    public function to(CaseFormat|string $format): string
    {
        return CaseConverter::convert($this->input, $format);
    }

    public function toCamel(): string
    {
        return CaseConverter::toCamel($this->input);
    }

    public function toPascal(): string
    {
        return CaseConverter::toPascal($this->input);
    }

    public function toSnake(): string
    {
        return CaseConverter::toSnake($this->input);
    }

    public function toKebab(): string
    {
        return CaseConverter::toKebab($this->input);
    }

    public function toMacro(): string
    {
        return CaseConverter::toMacro($this->input);
    }

    public function toTrain(): string
    {
        return CaseConverter::toTrain($this->input);
    }

    public function toDot(): string
    {
        return CaseConverter::toDot($this->input);
    }

    public function toLower(): string
    {
        return CaseConverter::toLower($this->input);
    }

    public function toUpper(): string
    {
        return CaseConverter::toUpper($this->input);
    }

    public function toTitle(): string
    {
        return CaseConverter::toTitle($this->input);
    }

    public function toPath(): string
    {
        return CaseConverter::toPath($this->input);
    }

    public function toAda(): string
    {
        return CaseConverter::toAda($this->input);
    }

    public function toCobol(): string
    {
        return CaseConverter::toCobol($this->input);
    }

    public function toSentence(): string
    {
        return CaseConverter::toSentence($this->input);
    }
}
