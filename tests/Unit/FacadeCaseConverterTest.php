<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Converter;
use DevJeetu\CaseConverter\DTOs\CaseFormatInfo;
use DevJeetu\CaseConverter\Exceptions\UnsupportedFormatException;
use PHPUnit\Framework\TestCase;

class FacadeCaseConverterTest extends TestCase
{
    public function testEnumConversion(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', Converter::convert($input, CaseType::SNAKE));
        $this->assertEquals('USER_NAME', Converter::convert($input, CaseType::MACRO));
        $this->assertEquals('userName', Converter::convert($input, CaseType::CAMEL));
        $this->assertEquals('UserName', Converter::convert($input, CaseType::PASCAL));
    }

    public function testStringConversion(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', Converter::convert($input, 'snake'));
        $this->assertEquals('user_name', Converter::convert($input, 'snake_case'));
        $this->assertEquals('user_name', Converter::convert($input, 'underscore'));

        $this->assertEquals('user-name', Converter::convert($input, 'kebab'));
        $this->assertEquals('user-name', Converter::convert($input, 'kebab-case'));
        $this->assertEquals('user-name', Converter::convert($input, 'dash'));
    }

    public function testConvertThrowsExceptionForInvalidFormat(): void
    {
        $this->expectException(UnsupportedFormatException::class);
        Converter::convert('test', 'invalid_format');
    }

    public function testGetSupportedFormats(): void
    {
        $formats = Converter::getSupportedFormats();
        $this->assertIsArray($formats);
        $this->assertContainsOnlyInstancesOf(CaseType::class, $formats);
        $this->assertCount(14, $formats);
    }

    public function testGetSupportedFormatNames(): void
    {
        $names = Converter::getSupportedFormatNames();
        $this->assertIsArray($names);
        $this->assertContains('snake', $names);
        $this->assertContains('camel', $names);
        $this->assertContains('pascal', $names);
    }

    public function testGetSupportedAliases(): void
    {
        $aliases = Converter::getSupportedAliases();
        $this->assertIsArray($aliases);
        $this->assertContains('snake', $aliases);
        $this->assertContains('camel', $aliases);
        $this->assertContains('kebab', $aliases);
        $this->assertContains('dash', $aliases);
    }

    public function testIsFormatSupported(): void
    {
        $this->assertTrue(Converter::isFormatSupported('snake'));
        $this->assertTrue(Converter::isFormatSupported('kebab-case'));
        $this->assertTrue(Converter::isFormatSupported('camel'));
        $this->assertFalse(Converter::isFormatSupported('invalid_format'));
    }

    public function testGetFormatInfoReturnsValidCaseFormatInfo(): void
    {
        foreach (CaseType::cases() as $case) {
            $info = Converter::getFormatInfo($case);

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
