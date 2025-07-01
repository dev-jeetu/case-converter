<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;
use PHPUnit\Framework\TestCase;

class PerformanceBenchmarkTest extends TestCase
{
    private const ITERATIONS = 1000;
    private const PERFORMANCE_THRESHOLD_MS = 100; // 100ms for 1000 iterations

    public function testCamelCasePerformance(): void
    {
        $input = 'very_long_string_with_many_words_to_test_performance';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::toCamel($input);
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; // Convert to milliseconds

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS,
            $executionTime,
            "CamelCase conversion took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testSnakeCasePerformance(): void
    {
        $input = 'veryLongStringWithManyWordsToTestPerformance';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::toSnake($input);
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS,
            $executionTime,
            "SnakeCase conversion took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testUnicodePerformance(): void
    {
        $input = 'πολύ-Καλό-με-πολλά-γράμματα';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::toSnake($input);
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS * 2, // Allow more time for Unicode
            $executionTime,
            "Unicode conversion took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testAcronymHandlingPerformance(): void
    {
        $input = 'XMLHttpRequestWithManyAcronymsLikeAPIJSONHTMLCSS';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::toSnake($input);
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS,
            $executionTime,
            "Acronym handling took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testEnumConversionPerformance(): void
    {
        $input = 'test_string_for_enum_conversion';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::convert($input, CaseFormat::CAMEL);
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS,
            $executionTime,
            "Enum conversion took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testStringFormatConversionPerformance(): void
    {
        $input = 'test_string_for_string_format_conversion';
        $startTime = microtime(true);

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            CaseConverter::convert($input, 'camel');
        }

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;

        $this->assertLessThan(
            self::PERFORMANCE_THRESHOLD_MS * 1.5, // Allow more time for string parsing
            $executionTime,
            "String format conversion took {$executionTime}ms for " . self::ITERATIONS . " iterations"
        );
    }

    public function testBulkConversions(): void
    {
        $inputs = array_fill(0, 1000, 'someVariableName');

        $start = microtime(true);
        foreach ($inputs as $input) {
            CaseConverter::toSnake($input);
        }
        $end = microtime(true);

        // Should complete 1000 conversions in less than 0.1 seconds
        $this->assertLessThan(0.1, $end - $start, 'Bulk conversions should be fast');
    }

    public function testComplexStringConversion(): void
    {
        $complexString = 'XMLHttpRequestParserWithJSONWebTokenAndHTTPSConnection';

        $start = microtime(true);
        $result = CaseConverter::toSnake($complexString);
        $end = microtime(true);

        $this->assertLessThan(0.002, $end - $start, 'Complex string conversion should be fast');
        $this->assertEquals('xml_http_request_parser_with_json_web_token_and_https_connection', $result);
    }
} 