<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\BaseCaseConverter;
use PHPUnit\Framework\TestCase;

class BaseCaseConverterTest extends TestCase
{
    /**
     * @dataProvider baseConversionProvider
     */
    public function testBaseCaseConversion(string $input, string $delimiter, string $expected): void
    {
        $result = BaseCaseConverter::convert($input, $delimiter);
        $this->assertEquals($expected, $result, "Base conversion failed for input: '$input' with delimiter: '$delimiter'");
    }

    /**
     * @return array<array<string>>
     */
    public static function baseConversionProvider(): array
    {
        return [
            // [input, delimiter, expected]
            ['userName', '_', 'user_Name'],
            ['userName', '-', 'user-Name'],
            ['userName', '.', 'user.Name'],
            ['userName', '/', 'user/Name'],
            ['userName', ' ', 'user Name'],

            ['XMLHttpRequest', '_', 'XML_Http_Request'],
            ['XMLHttpRequest', '-', 'XML-Http-Request'],
            ['XMLHttpRequest', '.', 'XML.Http.Request'],

            ['parseHTML', '_', 'parse_HTML'],
            ['parseHTML', '-', 'parse-HTML'],

            ['user-name', '_', 'user_name'],
            ['user.name', '_', 'user_name'],
            ['user name', '_', 'user_name'],
            ['user/name', '_', 'user_name'],

            ['APIKey', '_', 'API_Key'],
            ['APIKey', '-', 'API-Key'],

            ['iPhone', '_', 'i_Phone'],
            ['macOS', '_', 'mac_OS'],

            ['', '_', ''],
            ['', '-', ''],

            ['a', '_', 'a'],
            ['A', '_', 'A'],

            ['user123Name', '_', 'user123_Name'],
            ['version2Point1', '_', 'version2_Point1'],
        ];
    }

    public function testDefaultDelimiter(): void
    {
        // Test that the default delimiter is underscored
        $result1 = BaseCaseConverter::convert('userName');
        $result2 = BaseCaseConverter::convert('userName', '_');

        $this->assertEquals($result2, $result1, 'Default delimiter should be underscore');
    }

    public function testEmptyStringHandling(): void
    {
        $this->assertEquals('', BaseCaseConverter::convert(''));
        $this->assertEquals('', BaseCaseConverter::convert('', '_'));
        $this->assertEquals('', BaseCaseConverter::convert('', '-'));
        $this->assertEquals('', BaseCaseConverter::convert('', '.'));
    }

    public function testWhitespaceHandling(): void
    {
        $this->assertEquals('', BaseCaseConverter::convert(' '));
        $this->assertEquals('', BaseCaseConverter::convert('  '));
        $this->assertEquals('', BaseCaseConverter::convert("\t"));
        $this->assertEquals('', BaseCaseConverter::convert("\n"));
    }

    public function testMultipleSeparators(): void
    {
        $this->assertEquals('user_name', BaseCaseConverter::convert('user__name'));
        $this->assertEquals('user_name', BaseCaseConverter::convert('user--name'));
        $this->assertEquals('user_name', BaseCaseConverter::convert('user..name'));
        $this->assertEquals('user_name', BaseCaseConverter::convert('user  name'));
        $this->assertEquals('user_name', BaseCaseConverter::convert('user//name'));
    }

    public function testLeadingTrailingSeparators(): void
    {
        $this->assertEquals('user_Name', BaseCaseConverter::convert('_userName'));
        $this->assertEquals('user_Name', BaseCaseConverter::convert('userName_'));
        $this->assertEquals('user_Name', BaseCaseConverter::convert('__userName__'));

        $this->assertEquals('user_Name', BaseCaseConverter::convert('-userName'));
        $this->assertEquals('user_Name', BaseCaseConverter::convert('userName-'));

        $this->assertEquals('user_Name', BaseCaseConverter::convert(' userName'));
        $this->assertEquals('user_Name', BaseCaseConverter::convert('userName '));
    }

    public function testPreservesCase(): void
    {
        // Test that BaseCaseConverter preserves an original case
        $this->assertEquals('XML_Http_Request', BaseCaseConverter::convert('XMLHttpRequest'));
        $this->assertEquals('parse_HTML', BaseCaseConverter::convert('parseHTML'));
        $this->assertEquals('API_Key', BaseCaseConverter::convert('APIKey'));
        $this->assertEquals('i_Phone', BaseCaseConverter::convert('iPhone'));
        $this->assertEquals('mac_OS', BaseCaseConverter::convert('macOS'));
    }

    public function testComplexInputs(): void
    {
        $complex = 'complex_api-response.data space/path';
        $expected = 'complex_api_response_data_space_path';
        $this->assertEquals($expected, BaseCaseConverter::convert($complex));

        $mixedCase = 'XMLHttpRequest_parseHTML-getAPI.keyValue';
        $expected = 'XML_Http_Request_parse_HTML_get_API_key_Value';
        $this->assertEquals($expected, BaseCaseConverter::convert($mixedCase));
    }

    public function testNumericInputs(): void
    {
        $this->assertEquals('user123_Name', BaseCaseConverter::convert('user123Name'));
        $this->assertEquals('version2_Point1', BaseCaseConverter::convert('version2Point1'));
        $this->assertEquals('api2_Version', BaseCaseConverter::convert('api2Version'));
        $this->assertEquals('HTML5_Parser', BaseCaseConverter::convert('HTML5Parser'));
    }

    public function testAcronymPreservation(): void
    {
        // Test that acronyms are preserved in their original case
        $testCases = [
            'XMLParser' => 'XML_Parser',
            'HTMLElement' => 'HTML_Element',
            'JSONData' => 'JSON_Data',
            'HTTPSConnection' => 'HTTPS_Connection',
            'parseHTML' => 'parse_HTML',
            'getXMLData' => 'get_XML_Data',
            'XMLHttpRequest' => 'XML_Http_Request',
        ];

        foreach ($testCases as $input => $expected) {
            $this->assertEquals($expected, BaseCaseConverter::convert($input), "Acronym preservation failed for: $input");
        }
    }

    public function testCustomDelimiters(): void
    {
        $input = 'userName';

        $this->assertEquals('user_Name', BaseCaseConverter::convert($input, '_'));
        $this->assertEquals('user-Name', BaseCaseConverter::convert($input, '-'));
        $this->assertEquals('user.Name', BaseCaseConverter::convert($input, '.'));
        $this->assertEquals('user Name', BaseCaseConverter::convert($input, ' '));
        $this->assertEquals('user/Name', BaseCaseConverter::convert($input, '/'));
        $this->assertEquals('user|Name', BaseCaseConverter::convert($input, '|'));
        $this->assertEquals('user:Name', BaseCaseConverter::convert($input, ':'));
    }

    public function testPerformance(): void
    {
        $longInput = str_repeat('veryLongVariableName', 50);

        $start = microtime(true);
        $result = BaseCaseConverter::convert($longInput);
        $end = microtime(true);

        $this->assertLessThan(0.1, $end - $start, 'BaseCaseConverter should handle long strings efficiently');
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }
}
