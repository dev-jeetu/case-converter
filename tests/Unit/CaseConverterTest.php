<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\Converters\CamelCaseConverter;
use DevJeetu\CaseConverter\Converters\ConstantCaseConverter;
use DevJeetu\CaseConverter\Converters\DotCaseConverter;
use DevJeetu\CaseConverter\Converters\KebabCaseConverter;
use DevJeetu\CaseConverter\Converters\PascalCaseConverter;
use DevJeetu\CaseConverter\Converters\PathCaseConverter;
use DevJeetu\CaseConverter\Converters\ScreamedSnakeCaseConverter;
use DevJeetu\CaseConverter\Converters\SnakeCaseConverter;
use DevJeetu\CaseConverter\Converters\SpaceCaseConverter;
use DevJeetu\CaseConverter\Converters\TitleCaseConverter;
use DevJeetu\CaseConverter\Converters\TrainCaseConverter;
use PHPUnit\Framework\TestCase;

class CaseConverterTest extends TestCase
{
    /**
     * @dataProvider caseConversionProvider
     */
    public function testAllCaseConversions(
        string $input,
        string $snakeCase,
        string $screamedSnakeCase,
        string $camelCase,
        string $pascalCase,
        string $kebabCase,
        string $trainCase,
        string $dotCase,
        string $spaceCase,
        string $pathCase,
        string $titleCase
    ): void {
        $this->assertEquals($snakeCase, SnakeCaseConverter::convert($input), "Snake case failed for: $input");
        $this->assertEquals($screamedSnakeCase, ScreamedSnakeCaseConverter::convert($input), "Screamed snake case failed for: $input");
        $this->assertEquals($camelCase, CamelCaseConverter::convert($input), "Camel case failed for: $input");
        $this->assertEquals($pascalCase, PascalCaseConverter::convert($input), "Pascal case failed for: $input");
        $this->assertEquals($kebabCase, KebabCaseConverter::convert($input), "Kebab case failed for: $input");
        $this->assertEquals($trainCase, TrainCaseConverter::convert($input), "Train case failed for: $input");
        $this->assertEquals($dotCase, DotCaseConverter::convert($input), "Dot case failed for: $input");
        $this->assertEquals($spaceCase, SpaceCaseConverter::convert($input), "Space case failed for: $input");
        $this->assertEquals($pathCase, PathCaseConverter::convert($input), "Path case failed for: $input");
        $this->assertEquals($titleCase, TitleCaseConverter::convert($input), "Title case failed for: $input");
    }

    /**
     * @return array<array<string>>
     */
    public static function caseConversionProvider(): array
    {
        return [
            // [input, snake_case, SCREAMED_SNAKE, camelCase, PascalCase, kebab-case, Train-Case, dot.case, space case, path/case, Title Case]
            [
                '', // Empty string
                '', '', '', '', '', '', '', '', '', '',
            ],
            [
                'userName',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'FirstName',
                'first_name', 'FIRST_NAME', 'firstName', 'FirstName', 'first-name', 'First-Name', 'first.name', 'first name', 'first/name', 'First Name',
            ],
            [
                'user-name',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'user_name',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'user.name',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'user name',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'user/name',
                'user_name', 'USER_NAME', 'userName', 'UserName', 'user-name', 'User-Name', 'user.name', 'user name', 'user/name', 'User Name',
            ],
            [
                'userFirstName',
                'user_first_name', 'USER_FIRST_NAME', 'userFirstName', 'UserFirstName', 'user-first-name', 'User-First-Name', 'user.first.name', 'user first name', 'user/first/name', 'User First Name',
            ],
            [
                'APIKey',
                'api_key', 'API_KEY', 'APIKey', 'APIKey', 'api-key', 'API-Key', 'api.key', 'api key', 'api/key', 'API Key',
            ],
            [
                'XMLHttpRequest',
                'xml_http_request', 'XML_HTTP_REQUEST', 'XMLHttpRequest', 'XMLHttpRequest', 'xml-http-request', 'XML-Http-Request', 'xml.http.request', 'xml http request', 'xml/http/request', 'XML Http Request',
            ],
            [
                'JSONWebToken',
                'json_web_token', 'JSON_WEB_TOKEN', 'JSONWebToken', 'JSONWebToken', 'json-web-token', 'JSON-Web-Token', 'json.web.token', 'json web token', 'json/web/token', 'JSON Web Token',
            ],
            [
                'iPhone',
                'i_phone', 'I_PHONE', 'iPhone', 'IPhone', 'i-phone', 'I-Phone', 'i.phone', 'i phone', 'i/phone', 'I Phone',
            ],
            [
                'iOS',
                'i_os', 'I_OS', 'iOS', 'IOS', 'i-os', 'I-OS', 'i.os', 'i os', 'i/os', 'I OS',
            ],
            [
                'macOS',
                'mac_os', 'MAC_OS', 'macOS', 'MacOS', 'mac-os', 'Mac-OS', 'mac.os', 'mac os', 'mac/os', 'Mac OS',
            ],
            [
                'parseHTML',
                'parse_html', 'PARSE_HTML', 'parseHTML', 'ParseHTML', 'parse-html', 'Parse-HTML', 'parse.html', 'parse html', 'parse/html', 'Parse HTML',
            ],
            [
                'getHTTPSUrl',
                'get_https_url', 'GET_HTTPS_URL', 'getHTTPSUrl', 'GetHTTPSUrl', 'get-https-url', 'Get-HTTPS-Url', 'get.https.url', 'get https url', 'get/https/url', 'Get HTTPS Url',
            ],
            [
                'user123Name',
                'user123_name', 'USER123_NAME', 'user123Name', 'User123Name', 'user123-name', 'User123-Name', 'user123.name', 'user123 name', 'user123/name', 'User123 Name',
            ],
            [
                'complex_api-response.data space/path',
                'complex_api_response_data_space_path', 'COMPLEX_API_RESPONSE_DATA_SPACE_PATH', 'complexApiResponseDataSpacePath', 'ComplexApiResponseDataSpacePath', 'complex-api-response-data-space-path', 'Complex-Api-Response-Data-Space-Path', 'complex.api.response.data.space.path', 'complex api response data space path', 'complex/api/response/data/space/path', 'Complex Api Response Data Space Path',
            ],
        ];
    }

    /**
     * @dataProvider edgeCaseProvider
     */
    public function testEdgeCases(string $input, string $expectedSnake): void
    {
        $this->assertEquals($expectedSnake, SnakeCaseConverter::convert($input), "Edge case failed for: '$input'");
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
                SnakeCaseConverter::convert($input),
                CaseConverter::toSnakeCase($input),
                "Facade toSnakeCase doesn't match direct converter for: $input"
            );

            $this->assertEquals(
                CamelCaseConverter::convert($input),
                CaseConverter::toCamelCase($input),
                "Facade toCamelCase doesn't match direct converter for: $input"
            );

            $this->assertEquals(
                PascalCaseConverter::convert($input),
                CaseConverter::toPascalCase($input),
                "Facade toPascalCase doesn't match direct converter for: $input"
            );

            $this->assertEquals(
                KebabCaseConverter::convert($input),
                CaseConverter::toKebabCase($input),
                "Facade toKebabCase doesn't match direct converter for: $input"
            );
        }
    }

    public function testAliasConverters(): void
    {
        $input = 'testValue';

        // Test that alias converters work the same as their main counterparts
        $this->assertEquals(
            ScreamedSnakeCaseConverter::convert($input),
            ConstantCaseConverter::convert($input),
            'ConstantCaseConverter should match ScreamedSnakeCaseConverter'
        );
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
            $snake = SnakeCaseConverter::convert($input);
            $camel = CamelCaseConverter::convert($input);
            $pascal = PascalCaseConverter::convert($input);
            $kebab = KebabCaseConverter::convert($input);

            // Converting a snake case should be idempotent
            $this->assertEquals($snake, SnakeCaseConverter::convert($snake), "Snake case not idempotent for: $input");

            // Converting camel case should be idempotent
            $this->assertEquals($camel, CamelCaseConverter::convert($camel), "Camel case not idempotent for: $input");

            // Converting pascal case should be idempotent
            $this->assertEquals($pascal, PascalCaseConverter::convert($pascal), "Pascal case not idempotent for: $input");

            // Converting a kebab case should be idempotent
            $this->assertEquals($kebab, KebabCaseConverter::convert($kebab), "Kebab case not idempotent for: $input");
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
            $this->assertEquals($snake, SnakeCaseConverter::convert($input), "Acronym snake case failed for: $input");
            $this->assertEquals($screamed, ScreamedSnakeCaseConverter::convert($input), "Acronym screamed snake case failed for: $input");
            $this->assertEquals($camel, CamelCaseConverter::convert($input), "Acronym camel case failed for: $input");
            $this->assertEquals($pascal, PascalCaseConverter::convert($input), "Acronym pascal case failed for: $input");
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
            $this->assertEquals($snake, SnakeCaseConverter::convert($input), "Numeric snake case failed for: $input");
            $this->assertEquals($screamed, ScreamedSnakeCaseConverter::convert($input), "Numeric screamed snake case failed for: $input");
            $this->assertEquals($camel, CamelCaseConverter::convert($input), "Numeric camel case failed for: $input");
            $this->assertEquals($pascal, PascalCaseConverter::convert($input), "Numeric pascal case failed for: $input");
        }
    }

    public function testPerformanceWithLongStrings(): void
    {
        // Test with a very long string to ensure no performance issues
        $longString = str_repeat('veryLongVariableName', 100);

        $start = microtime(true);
        $result = SnakeCaseConverter::convert($longString);
        $end = microtime(true);

        $this->assertLessThan(1.0, $end - $start, 'Conversion should complete within 1 second');
        $this->assertIsString($result, 'Should return a string');
        $this->assertNotEmpty($result, 'Should not return empty string for non-empty input');
    }
}
