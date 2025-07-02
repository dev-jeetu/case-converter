<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\Converter;
use DevJeetu\CaseConverter\Converters\AdaCase;
use DevJeetu\CaseConverter\Converters\CamelCase;
use DevJeetu\CaseConverter\Converters\CobolCase;
use DevJeetu\CaseConverter\Converters\DotCase;
use DevJeetu\CaseConverter\Converters\KebabCase;
use DevJeetu\CaseConverter\Converters\LowerCase;
use DevJeetu\CaseConverter\Converters\MacroCase;
use DevJeetu\CaseConverter\Converters\PascalCase;
use DevJeetu\CaseConverter\Converters\PathCase;
use DevJeetu\CaseConverter\Converters\SentenceCase;
use DevJeetu\CaseConverter\Converters\SnakeCase;
use DevJeetu\CaseConverter\Converters\TitleCase;
use DevJeetu\CaseConverter\Converters\TrainCase;
use DevJeetu\CaseConverter\Converters\UpperCase;
use PHPUnit\Framework\TestCase;

class CoreCaseConverterTest extends TestCase
{
    /**
     * @dataProvider caseConversionProvider
     */
    /**
     * @dataProvider caseConversionProvider
     * @param array<string, string> $expectedCases
     */
    public function testAllCaseConversions(string $input, array $expectedCases): void
    {
        $this->assertEquals($expectedCases['snake'], SnakeCase::convert($input), "Snake case failed for: $input");
        $this->assertEquals($expectedCases['macro'], MacroCase::convert($input), "Macro case failed for: $input");
        $this->assertEquals($expectedCases['camel'], CamelCase::convert($input), "Camel case failed for: $input");
        $this->assertEquals($expectedCases['pascal'], PascalCase::convert($input), "Pascal case failed for: $input");
        $this->assertEquals($expectedCases['kebab'], KebabCase::convert($input), "Kebab case failed for: $input");
        $this->assertEquals($expectedCases['train'], TrainCase::convert($input), "Train case failed for: $input");
        $this->assertEquals($expectedCases['dot'], DotCase::convert($input), "Dot case failed for: $input");
        $this->assertEquals($expectedCases['lower'], LowerCase::convert($input), "Lower case failed for: $input");
        $this->assertEquals($expectedCases['upper'], UpperCase::convert($input), "Upper case failed for: $input");
        $this->assertEquals($expectedCases['title'], TitleCase::convert($input), "Title case failed for: $input");
        $this->assertEquals($expectedCases['path'], PathCase::convert($input), "Path case failed for: $input");
        $this->assertEquals($expectedCases['ada'], AdaCase::convert($input), "Ada case failed for: $input");
        $this->assertEquals($expectedCases['cobol'], CobolCase::convert($input), "Cobol case failed for: $input");
        $this->assertEquals($expectedCases['sentence'], SentenceCase::convert($input), "Sentence case failed for: $input");
    }

    /**
     * @return array<array{string, array<string, string>}>
     */
    public static function caseConversionProvider(): array
    {
        $path = realpath(__DIR__ . '/../Fixtures/case_conversions.json');
        if ($path === false) {
            throw new \RuntimeException('Unable to find case_conversions.json');
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new \RuntimeException('Unable to read case_conversions.json');
        }

        /** @var array<array{input: string, cases: array<string, string>}> $data */
        $data = json_decode($json, true);

        return array_map(function ($item) {
            return [$item['input'], $item['cases']];
        }, $data);
    }

    /**
     * @dataProvider edgeCaseProvider
     */
    public function testEdgeCases(string $input, string $expectedSnake): void
    {
        $this->assertEquals($expectedSnake, SnakeCase::convert($input), "Edge case failed for: '$input'");
    }

    /**
     * @return array<array<string>>
     */
    public static function edgeCaseProvider(): array
    {
        return [
            // Empty and whitespace
            ['', ''],
            [' ', ''],
            ['   ', ''],
            ["\t", ''],
            ["\n", ''],

            // Single characters
            ['a', 'a'],
            ['A', 'a'],
            ['1', '1'],

            // Multiple separators
            ['user__name', 'user_name'],
            ['user--name', 'user_name'],
            ['user..name', 'user_name'],
            ['user  name', 'user_name'],
            ['user//name', 'user_name'],
            ['user_-name', 'user_name'],
            ['user.-name', 'user_name'],
            ['user -name', 'user_name'],
            ['user/_name', 'user_name'],

            // Leading/trailing separators
            ['_userName', 'user_name'],
            ['userName_', 'user_name'],
            ['-userName', 'user_name'],
            ['userName-', 'user_name'],
            ['.userName', 'user_name'],
            ['userName.', 'user_name'],
            [' userName', 'user_name'],
            ['userName ', 'user_name'],
            ['/userName', 'user_name'],
            ['userName/', 'user_name'],

            // Multiple leading/trailing
            ['__userName__', 'user_name'],
            ['--userName--', 'user_name'],
            ['..userName..', 'user_name'],
            ['  userName  ', 'user_name'],
            ['//userName//', 'user_name'],

            // All caps
            ['HTML', 'html'],
            ['API', 'api'],
            ['URL', 'url'],

            // Mixed with numbers
            ['version2', 'version2'],
            ['Version2', 'version2'],
            ['VERSION2', 'version2'],
            ['user2Name', 'user2_name'],
            ['User2Name', 'user2_name'],

            // Complex acronyms
            ['XMLParser', 'xml_parser'],
            ['HTMLElement', 'html_element'],
            ['JSONData', 'json_data'],
            ['HTTPSConnection', 'https_connection'],

            // Already correct format
            ['user_name', 'user_name'],
            ['simple_text', 'simple_text'],
            ['complex_variable_name', 'complex_variable_name'],
        ];
    }

    public function testFacadeMethodsMatchDirectConverters(): void
    {
        $testCases = ['userName', 'XMLHttpRequest', 'user-name', 'parse_html'];

        foreach ($testCases as $input) {
            $this->assertEquals(
                SnakeCase::convert($input),
                Converter::toSnake($input),
                "toSnake mismatch for: $input"
            );

            $this->assertEquals(
                CamelCase::convert($input),
                Converter::toCamel($input),
                "toCamel mismatch for: $input"
            );

            $this->assertEquals(
                PascalCase::convert($input),
                Converter::toPascal($input),
                "toPascal mismatch for: $input"
            );

            $this->assertEquals(
                KebabCase::convert($input),
                Converter::toKebab($input),
                "toKebab mismatch for: $input"
            );

            $this->assertEquals(
                MacroCase::convert($input),
                Converter::toMacro($input),
                "toMacro mismatch for: $input"
            );

            $this->assertEquals(
                TrainCase::convert($input),
                Converter::toTrain($input),
                "toTrain mismatch for: $input"
            );

            $this->assertEquals(
                DotCase::convert($input),
                Converter::toDot($input),
                "toDot mismatch for: $input"
            );

            $this->assertEquals(
                LowerCase::convert($input),
                Converter::toLower($input),
                "toLower mismatch for: $input"
            );

            $this->assertEquals(
                UpperCase::convert($input),
                Converter::toUpper($input),
                "toUpper mismatch for: $input"
            );

            $this->assertEquals(
                TitleCase::convert($input),
                Converter::toTitle($input),
                "toTitle mismatch for: $input"
            );

            $this->assertEquals(
                PathCase::convert($input),
                Converter::toPath($input),
                "toPath mismatch for: $input"
            );

            $this->assertEquals(
                AdaCase::convert($input),
                Converter::toAda($input),
                "toAda mismatch for: $input"
            );

            $this->assertEquals(
                CobolCase::convert($input),
                Converter::toCobol($input),
                "toCobol mismatch for: $input"
            );

            $this->assertEquals(
                SentenceCase::convert($input),
                Converter::toSentence($input),
                "toSentence mismatch for: $input"
            );
        }
    }

    public function testConsistencyAcrossConverters(): void
    {
        $inputs = [
            'userName',
            'user-name',
            'user_name',
            'user.name',
            'user name',
            'user/name',
            'XMLHttpRequest',
        ];

        foreach ($inputs as $input) {
            // Test that all converters produce a consistent output when converting back and forth
            $snake = SnakeCase::convert($input);
            $camel = CamelCase::convert($input);
            $pascal = PascalCase::convert($input);
            $kebab = KebabCase::convert($input);

            // Converting a snake case should be idempotent
            $this->assertEquals($snake, SnakeCase::convert($snake), "Snake case not idempotent for: $input");

            // Converting camel case should be idempotent
            $this->assertEquals($camel, CamelCase::convert($camel), "Camel case not idempotent for: $input");

            // Converting pascal case should be idempotent
            $this->assertEquals($pascal, PascalCase::convert($pascal), "Pascal case not idempotent for: $input");

            // Converting a kebab case should be idempotent
            $this->assertEquals($kebab, KebabCase::convert($kebab), "Kebab case not idempotent for: $input");
        }
    }

    public function testAcronymHandling(): void
    {
        $acronymTestCases = [
            ['API', 'api', 'API', 'API', 'API'],
            ['XMLParser', 'xml_parser', 'XML_PARSER', 'XMLParser', 'XMLParser'],
            ['HTMLElement', 'html_element', 'HTML_ELEMENT', 'HTMLElement', 'HTMLElement'],
            ['HTTPSConnection', 'https_connection', 'HTTPS_CONNECTION', 'HTTPSConnection', 'HTTPSConnection'],
            ['JSONWebToken', 'json_web_token', 'JSON_WEB_TOKEN', 'JSONWebToken', 'JSONWebToken'],
            ['parseHTML', 'parse_html', 'PARSE_HTML', 'parseHTML', 'ParseHTML'],
            ['getHTTPSUrl', 'get_https_url', 'GET_HTTPS_URL', 'getHTTPSUrl', 'GetHTTPSUrl'],
        ];

        foreach ($acronymTestCases as [$input, $snake, $screamed, $camel, $pascal]) {
            $this->assertEquals($snake, SnakeCase::convert($input), "Acronym snake case failed for: $input");
            $this->assertEquals($screamed, MacroCase::convert($input), "Acronym screamed snake case failed for: $input");
            $this->assertEquals($camel, CamelCase::convert($input), "Acronym camel case failed for: $input");
            $this->assertEquals($pascal, PascalCase::convert($input), "Acronym pascal case failed for: $input");
        }
    }

    public function testNumericHandling(): void
    {
        $numericTestCases = [
            ['user1', 'user1', 'USER1', 'user1', 'User1'],
            ['User1', 'user1', 'USER1', 'user1', 'User1'],
            ['user123Name', 'user123_name', 'USER123_NAME', 'user123Name', 'User123Name'],
            ['User123Name', 'user123_name', 'USER123_NAME', 'user123Name', 'User123Name'],
            ['version2Point1', 'version2_point1', 'VERSION2_POINT1', 'version2Point1', 'Version2Point1'],
            ['api2Version', 'api2_version', 'API2_VERSION', 'api2Version', 'Api2Version'],
        ];

        foreach ($numericTestCases as [$input, $snake, $screamed, $camel, $pascal]) {
            $this->assertEquals($snake, SnakeCase::convert($input), "Numeric snake case failed for: $input");
            $this->assertEquals($screamed, MacroCase::convert($input), "Numeric screamed snake case failed for: $input");
            $this->assertEquals($camel, CamelCase::convert($input), "Numeric camel case failed for: $input");
            $this->assertEquals($pascal, PascalCase::convert($input), "Numeric pascal case failed for: $input");
        }
    }

    public function testPerformanceWithLongStrings(): void
    {
        // Test with a very long string to ensure no performance issues
        $longString = str_repeat('veryLongVariableName', 100);

        $start = microtime(true);
        $result = SnakeCase::convert($longString);
        $end = microtime(true);

        $this->assertLessThan(1.0, $end - $start, 'Conversion should complete within 1 second');
        $this->assertIsString($result, 'Should return a string');
        $this->assertNotEmpty($result, 'Should not return empty string for non-empty input');
    }
}
