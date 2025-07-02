<?php

namespace DevJeetu\CaseConverter;

class FluentConverter
{
    public function __construct(private string $input)
    {
    }

    public function to(CaseType|string $format): string
    {
        return Converter::convert($this->input, $format);
    }

    public function toCamel(): string
    {
        return Converter::toCamel($this->input);
    }

    public function toPascal(): string
    {
        return Converter::toPascal($this->input);
    }

    public function toSnake(): string
    {
        return Converter::toSnake($this->input);
    }

    public function toKebab(): string
    {
        return Converter::toKebab($this->input);
    }

    public function toMacro(): string
    {
        return Converter::toMacro($this->input);
    }

    public function toTrain(): string
    {
        return Converter::toTrain($this->input);
    }

    public function toDot(): string
    {
        return Converter::toDot($this->input);
    }

    public function toLower(): string
    {
        return Converter::toLower($this->input);
    }

    public function toUpper(): string
    {
        return Converter::toUpper($this->input);
    }

    public function toTitle(): string
    {
        return Converter::toTitle($this->input);
    }

    public function toPath(): string
    {
        return Converter::toPath($this->input);
    }

    public function toAda(): string
    {
        return Converter::toAda($this->input);
    }

    public function toCobol(): string
    {
        return Converter::toCobol($this->input);
    }

    public function toSentence(): string
    {
        return Converter::toSentence($this->input);
    }
}
