<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;
use PHPUnit\Framework\TestCase;

class CaseConverterFacadeTest extends TestCase
{
    public function testEnumConversion(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', CaseConverter::convert($input, CaseFormat::SNAKE_CASE));
        $this->assertEquals('USER_NAME', CaseConverter::convert($input, CaseFormat::SCREAMED_SNAKE_CASE));
        $this->assertEquals('userName', CaseConverter::convert($input, CaseFormat::CAMEL_CASE));
        $this->assertEquals('UserName', CaseConverter::convert($input, CaseFormat::PASCAL_CASE));
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
        $this->assertCount(11, $formats); // We have 11 formats
    }

    public function testGetSupportedFormatNames(): void
    {
        $names = CaseConverter::getSupportedFormatNames();
        $this->assertIsArray($names);
        $this->assertContains('snake_case', $names);
        $this->assertContains('camelCase', $names);
        $this->assertContains('PascalCase', $names);
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

    public function testGetFormatInfo(): void
    {
        $info = CaseConverter::getFormatInfo(CaseFormat::SNAKE_CASE);
        $this->assertIsArray($info);
        $this->assertArrayHasKey('name', $info);
        $this->assertArrayHasKey('description', $info);
        $this->assertArrayHasKey('example', $info);
        $this->assertArrayHasKey('aliases', $info);
        $this->assertArrayHasKey('converter_class', $info);

        $this->assertEquals('snake_case', $info['name']);
        $this->assertEquals('user_name', $info['example']);
    }

    public function testGetFormatInfoWithString(): void
    {
        $info = CaseConverter::getFormatInfo('snake');
        $this->assertEquals('snake_case', $info['name']);
    }
}
