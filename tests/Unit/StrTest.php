<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\Helpers\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    /**
     * @dataProvider baseConversionProvider
     */
    public function testBaseCaseConversion(string $input, string $expected): void
    {
        $result = Str::convert($input);
        $this->assertEquals($expected, $result, "Base conversion failed for input: '$input'");
    }

    /**
     * @return array<array<string>>
     */
    public static function baseConversionProvider(): array
    {
        return [
            // [input, expected]
            ['userName', 'user Name'],

            ['XMLHttpRequest', 'XML Http Request'],
            ['parseHTML', 'parse HTML'],
            ['APIKey', 'API Key'],

            ['user-name', 'user name'],
            ['user.name', 'user name'],
            ['user name', 'user name'],
            ['user/name', 'user name'],

            ['iPhone', 'i Phone'],
            ['macOS', 'mac OS'],

            ['', ''],

            ['a', 'a'],
            ['A', 'A'],

            ['user123Name', 'user123 Name'],
            ['version2Point1', 'version2 Point1'],
        ];
    }

    public function testEmptyStringHandling(): void
    {
        $this->assertEquals('', Str::convert(''));
    }

    public function testWhitespaceHandling(): void
    {
        $this->assertEquals('', Str::convert(' '));
        $this->assertEquals('', Str::convert('  '));
        $this->assertEquals('', Str::convert("\t"));
        $this->assertEquals('', Str::convert("\n"));
    }

    public function testMultipleSeparators(): void
    {
        $this->assertEquals('user name', Str::convert('user__name'));
        $this->assertEquals('user name', Str::convert('user--name'));
        $this->assertEquals('user name', Str::convert('user..name'));
        $this->assertEquals('user name', Str::convert('user  name'));
        $this->assertEquals('user name', Str::convert('user//name'));
    }

    public function testLeadingTrailingSeparators(): void
    {
        $this->assertEquals('user Name', Str::convert('_userName'));
        $this->assertEquals('user Name', Str::convert('userName_'));
        $this->assertEquals('user Name', Str::convert('__userName__'));

        $this->assertEquals('user Name', Str::convert('-userName'));
        $this->assertEquals('user Name', Str::convert('userName-'));

        $this->assertEquals('user Name', Str::convert(' userName'));
        $this->assertEquals('user Name', Str::convert('userName '));
    }

    public function testPreservesCase(): void
    {
        // Test that Str preserves an original case
        $this->assertEquals('XML Http Request', Str::convert('XMLHttpRequest'));
        $this->assertEquals('parse HTML', Str::convert('parseHTML'));
        $this->assertEquals('API Key', Str::convert('APIKey'));
        $this->assertEquals('i Phone', Str::convert('iPhone'));
        $this->assertEquals('mac OS', Str::convert('macOS'));
    }

    public function testComplexInputs(): void
    {
        $complex = 'complex_api-response.data space/path';
        $expected = 'complex api response data space path';
        $this->assertEquals($expected, Str::convert($complex));

        $mixedCase = 'XMLHttpRequest_parseHTML-getAPI.keyValue';
        $expected = 'XML Http Request parse HTML get API key Value';
        $this->assertEquals($expected, Str::convert($mixedCase));
    }

    public function testNumericInputs(): void
    {
        $this->assertEquals('user123 Name', Str::convert('user123Name'));
        $this->assertEquals('version2 Point1', Str::convert('version2Point1'));
        $this->assertEquals('api2 Version', Str::convert('api2Version'));
        $this->assertEquals('HTML5 Parser', Str::convert('HTML5Parser'));
    }

    public function testAcronymPreservation(): void
    {
        // Test that acronyms are preserved in their original case
        $testCases = [
            'XMLParser' => 'XML Parser',
            'HTMLElement' => 'HTML Element',
            'JSONData' => 'JSON Data',
            'HTTPSConnection' => 'HTTPS Connection',
            'parseHTML' => 'parse HTML',
            'getXMLData' => 'get XML Data',
            'XMLHttpRequest' => 'XML Http Request',
        ];

        foreach ($testCases as $input => $expected) {
            $this->assertEquals($expected, Str::convert($input), "Acronym preservation failed for: $input");
        }
    }

    public function testPerformance(): void
    {
        $longInput = str_repeat('veryLongVariableName', 50);

        $start = microtime(true);
        $result = Str::convert($longInput);
        $end = microtime(true);

        $this->assertLessThan(0.1, $end - $start, 'Str should handle long strings efficiently');
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }
}
