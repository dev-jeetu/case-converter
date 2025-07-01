<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class CaseConverterIntegrationTest extends TestCase
{
    public function testRealWorldApiTransformation(): void
    {
        // Simulate API response transformation
        $apiResponse = [
            'user_id' => 123,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email_address' => 'john@example.com',
            'created_at' => '2023-01-01',
            'is_active' => true,
        ];

        $frontendData = [];
        foreach ($apiResponse as $key => $value) {
            $frontendData[CaseConverter::toCamelCase($key)] = $value;
        }

        $expected = [
            'userId' => 123,
            'firstName' => 'John',
            'lastName' => 'Doe',
            'emailAddress' => 'john@example.com',
            'createdAt' => '2023-01-01',
            'isActive' => true,
        ];

        $this->assertEquals($expected, $frontendData);
    }

    public function testDatabaseToPhpMapping(): void
    {
        // Simulate database column to PHP property mapping
        $dbColumns = ['user_name', 'email_address', 'phone_number', 'created_at'];
        $phpProperties = [];

        foreach ($dbColumns as $column) {
            $phpProperties[] = CaseConverter::toCamelCase($column);
        }

        $expected = ['userName', 'emailAddress', 'phoneNumber', 'createdAt'];
        $this->assertEquals($expected, $phpProperties);
    }

    public function testUrlSlugGeneration(): void
    {
        $titles = [
            'My Blog Post Title',
            'Another Great Article',
            'How to Use Case Converter',
        ];

        $slugs = [];
        foreach ($titles as $title) {
            $slugs[] = CaseConverter::toKebabCase($title);
        }

        $expected = [
            'my-blog-post-title',
            'another-great-article',
            'how-to-use-case-converter',
        ];

        $this->assertEquals($expected, $slugs);
    }
}
