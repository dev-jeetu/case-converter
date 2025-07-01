<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\DTOs\CaseFormatInfo;
use PHPUnit\Framework\TestCase;

class FacadeCaseConverterTest extends TestCase
{
    public function testEnumConversion(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', CaseConverter::convert($input, CaseFormat::SNAKE));
        $this->assertEquals('USER_NAME', CaseConverter::convert($input, CaseFormat::MACRO));
        $this->assertEquals('userName', CaseConverter::convert($input, CaseFormat::CAMEL));
        $this->assertEquals('UserName', CaseConverter::convert($input, CaseFormat::PASCAL));
    }

    public function testStringConversion(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', CaseConverter::convert($input, 'snake'));
        $this->assertEquals('user_name', CaseConverter::convert($input, 'snake_case'));
        $this->assertEquals('user_name', CaseConverter::convert($input, 'underscore'));

        $this->assertEquals('user-name', CaseConverter::convert($input, 'kebab'));
        $this->assertEquals('user-name', CaseConverter::convert($input, 'kebab-case'));
        $this->assertEquals('user-name', CaseConverter::convert($input, 'dash'));
    }

    public function testConvertThrowsExceptionForInvalidFormat(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        CaseConverter::convert('test', 'invalid_format');
    }

    public function testGetSupportedFormats(): void
    {
        $formats = CaseConverter::getSupportedFormats();
        $this->assertIsArray($formats);
        $this->assertContainsOnlyInstancesOf(CaseFormat::class, $formats);
        $this->assertCount(14, $formats);
    }

    public function testGetSupportedFormatNames(): void
    {
        $names = CaseConverter::getSupportedFormatNames();
        $this->assertIsArray($names);
        $this->assertContains('snake', $names);
        $this->assertContains('camel', $names);
        $this->assertContains('pascal', $names);
    }

    public function testGetSupportedAliases(): void
    {
        $aliases = CaseConverter::getSupportedAliases();
        $this->assertIsArray($aliases);
        $this->assertContains('snake', $aliases);
        $this->assertContains('camel', $aliases);
        $this->assertContains('kebab', $aliases);
        $this->assertContains('dash', $aliases);
    }

    public function testIsFormatSupported(): void
    {
        $this->assertTrue(CaseConverter::isFormatSupported('snake'));
        $this->assertTrue(CaseConverter::isFormatSupported('kebab-case'));
        $this->assertTrue(CaseConverter::isFormatSupported('camel'));
        $this->assertFalse(CaseConverter::isFormatSupported('invalid_format'));
    }

    public function testGetFormatInfoReturnsValidCaseFormatInfo(): void
    {
        foreach (CaseFormat::cases() as $case) {
            $info = CaseConverter::getFormatInfo($case);

            $this->assertInstanceOf(CaseFormatInfo::class, $info);
            $this->assertEquals($case->value, $info->name, "Name mismatch for $case->name");
            $this->assertIsString($info->emoji, "Emoji should be a string for $case->name");
            $this->assertIsString($info->description, "Description should be a string for $case->name");
            $this->assertEquals($case->getExample(), $info->example, "Example mismatch for $case->name");
            $this->assertEquals($case->getAliases(), $info->aliases, "Aliases mismatch for $case->name");
            $this->assertEquals($case->getDelimiter(), $info->delimiter, "Delimiter mismatch for $case->name");
            $this->assertEquals($case->getConverterClass(), $info->converterClass, "Converter class mismatch for $case->name");
            $this->assertEquals($case->isCapitalized(), $info->isCapitalized, "Capitalization mismatch for $case->name");
            $this->assertEquals($case->isUppercase(), $info->isUppercase, "Uppercase mismatch for $case->name");
            $this->assertEquals($case->isLowercase(), $info->isLowercase, "Lowercase mismatch for $case->name");
        }
    }
}
