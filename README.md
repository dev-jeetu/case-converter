# DevJeetu/CaseConverter

[![Latest Stable Version](https://poser.pugx.org/dev-jeetu/case-converter/v/stable)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Total Downloads](https://poser.pugx.org/dev-jeetu/case-converter/downloads)](https://packagist.org/packages/dev-jeetu/case-converter)
[![License](https://poser.pugx.org/dev-jeetu/case-converter/license)](https://packagist.org/packages/dev-jeetu/case-converter)
[![PHP Version Require](https://poser.pugx.org/dev-jeetu/case-converter/require/php)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Tests](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml/badge.svg)](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml)

A comprehensive PHP library for converting between different naming conventions. Supports snake_case, camelCase, PascalCase, kebab-case, and many more with proper acronym handling.

## ✨ Features

- 🔄 **11 different case formats** supported
- 🎯 **Proper acronym handling** (XML, HTTP, API, etc.)
- 🔒 **Type-safe enum-based API** with full IDE support
- 🚀 **High performance** with optimized algorithms
- 🧪 **100% test coverage** with comprehensive test suite
- 📝 **Fluent API** for easy chaining
- 🔧 **Zero dependencies** - pure PHP implementation
- 📦 **PSR-4 autoloading** compatible
- 🐘 **PHP 8.1+** support with strict types

## 📦 Installation

Install via Composer:

```bash
composer require dev-jeetu/case-converter
```

## 🚀 Quick Start

```php
use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;

// Simple conversions
echo CaseConverter::toSnakeCase('firstName');        // first_name
echo CaseConverter::toCamelCase('first_name');       // firstName
echo CaseConverter::toPascalCase('user-profile');    // UserProfile
echo CaseConverter::toKebabCase('UserName');         // user-name

// Type-safe enum usage
echo CaseConverter::convert('userName', CaseFormat::SNAKE_CASE);   // user_name
echo CaseConverter::convert('user_id', CaseFormat::PASCAL_CASE);   // UserId

// Proper acronym handling
echo CaseConverter::toSnakeCase('XMLHttpRequest');   // xml_http_request
echo CaseConverter::toCamelCase('parse_html');       // parseHTML
echo CaseConverter::toPascalCase('json_web_token');  // JSONWebToken

// Fluent interface
echo CaseConverter::from('user_name')->toPascalCase(); // UserName
echo CaseConverter::from('XMLParser')->toKebabCase();  // xml-parser
```

## 📚 Supported Formats

| Format | Example | Method | Enum |
|--------|---------|--------|------|
| snake_case | `user_name` | `toSnakeCase()` | `CaseFormat::SNAKE_CASE` |
| SCREAMED_SNAKE_CASE | `USER_NAME` | `toScreamedSnakeCase()` | `CaseFormat::SCREAMED_SNAKE_CASE` |
| camelCase | `userName` | `toCamelCase()` | `CaseFormat::CAMEL_CASE` |
| PascalCase | `UserName` | `toPascalCase()` | `CaseFormat::PASCAL_CASE` |
| kebab-case | `user-name` | `toKebabCase()` | `CaseFormat::KEBAB_CASE` |
| Train-Case | `User-Name` | `toTrainCase()` | `CaseFormat::TRAIN_CASE` |
| dot.case | `user.name` | `toDotCase()` | `CaseFormat::DOT_CASE` |
| space case | `user name` | `toSpaceCase()` | `CaseFormat::SPACE_CASE` |
| path/case | `user/name` | `toPathCase()` | `CaseFormat::PATH_CASE` |
| Title Case | `User Name` | `toTitleCase()` | `CaseFormat::TITLE_CASE` |
| CONSTANT_CASE | `USER_NAME` | `toConstantCase()` | `CaseFormat::CONSTANT_CASE` |

## 🎯 Advanced Usage

### Type-Safe Enum API

```php
use DevJeetu\CaseConverter\CaseFormat;

// Type-safe conversions
$format = CaseFormat::SNAKE_CASE;
echo $format->convert('firstName');     // first_name

// Get format information
echo $format->getDescription();         // "Lowercase words separated by underscores"
echo $format->getExample();            // user_name
print_r($format->getAliases());        // ['snake', 'snake_case', 'underscore']

// Find format by string
$format = CaseFormat::fromString('kebab-case');
echo $format->convert('userName');      // user-name
```

### Generic Conversion with Aliases

```php
// All these work (case-insensitive)
echo CaseConverter::convert('firstName', 'snake');        // first_name
echo CaseConverter::convert('firstName', 'kebab-case');   // first-name
echo CaseConverter::convert('firstName', 'dash');         // first-name
echo CaseConverter::convert('firstName', 'hyphen');       // first-name

// String or enum - both work
echo CaseConverter::convert('user_id', 'pascal');         // UserId
echo CaseConverter::convert('user_id', CaseFormat::PASCAL_CASE); // UserId
```

### Format Introspection

```php
// Check if format is supported
if (CaseConverter::isFormatSupported('snake_case')) {
    // Convert safely
}

// Get all supported formats
$formats = CaseConverter::getSupportedFormats();        // Array of CaseFormat enums
$names = CaseConverter::getSupportedFormatNames();      // Array of format names
$aliases = CaseConverter::getSupportedAliases();        // All possible aliases

// Get detailed format information
$info = CaseConverter::getFormatInfo(CaseFormat::CAMEL_CASE);
/*
[
    'name' => 'camelCase',
    'description' => 'First word lowercase, subsequent words capitalized, no separators',
    'example' => 'userName',
    'aliases' => ['camel', 'camelcase', 'lower_camel'],
    'converter_class' => 'DevJeetu\CaseConverter\Converters\CamelCaseConverter'
]
*/
```

### Fluent Interface

```php
use DevJeetu\CaseConverter\CaseConverter;

// Method chaining
$result = CaseConverter::from('XMLHttpRequest')
    ->toSnakeCase();  // xml_http_request

// Convert to any format
$result = CaseConverter::from('user_profile')
    ->to('pascal');   // UserProfile

$result = CaseConverter::from('firstName')
    ->to(CaseFormat::KEBAB_CASE);  // first-name
```

### Individual Converters

```php
use DevJeetu\CaseConverter\Converters\SnakeCase;
use DevJeetu\CaseConverter\Converters\CamelCase;

echo SnakeCase::convert('firstName');  // first_name
echo CamelCase::convert('user_name');  // userName
```

## 🧠 Acronym Handling

The library intelligently handles acronyms and preserves them in appropriate contexts:

```php
// Leading acronyms are preserved in camelCase and PascalCase
echo CaseConverter::toCamelCase('xml_parser');     // XMLParser (not xmlParser)
echo CaseConverter::toPascalCase('html_element');  // HTMLElement (not HtmlElement)

// Trailing acronyms are preserved
echo CaseConverter::toCamelCase('parse_html');     // parseHTML (not parseHtml)
echo CaseConverter::toSnakeCase('parseHTML');      // parse_html

// Complex acronym combinations
echo CaseConverter::toSnakeCase('XMLHttpRequest'); // xml_http_request
echo CaseConverter::toCamelCase('get_https_url');  // getHTTPSUrl
echo CaseConverter::toPascalCase('json_web_token'); // JSONWebToken

// Brand names with special casing
echo CaseConverter::toSnakeCase('iPhone');         // i_phone
echo CaseConverter::toPascalCase('mac_os');        // MacOS
```

## 🔧 Supported Aliases

Each format supports multiple aliases for convenience:

| Format | Aliases |
|--------|---------|
| snake_case | `snake`, `snake_case`, `underscore` |
| SCREAMED_SNAKE_CASE | `screamed`, `screamed_snake`, `screaming_snake`, `upper_snake`, `macro` |
| camelCase | `camel`, `camelcase`, `lower_camel` |
| PascalCase | `pascal`, `pascalcase`, `upper_camel`, `studly` |
| kebab-case | `kebab`, `kebab-case`, `dash`, `hyphen`, `lisp` |
| Train-Case | `train`, `train-case`, `pascal-kebab` |
| dot.case | `dot`, `dot.case`, `period` |
| space case | `space`, `space case`, `lower space` |
| path/case | `path`, `path/case`, `slash`, `directory` |
| Title Case | `title`, `title case`, `start case` |
| CONSTANT_CASE | `constant`, `upper`, `macro`, `screaming` |

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
composer test

# Run tests with coverage report
composer test-coverage

# Run quality checks (tests + static analysis + code style)
composer quality
```

## 🔧 Development

```bash
# Install dependencies
composer install

# Run tests
composer test

# Fix code style
composer cs-fix

# Run static analysis
composer phpstan

# Run all quality checks
composer quality
```

## 📋 Requirements

- PHP 8.1 or higher
- No external dependencies

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for your changes
5. Ensure all tests pass (`composer quality`)
6. Commit your changes (`git commit -am 'Add amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

## 📝 Examples

### Real-world Usage Examples

```php
// API response transformation
$apiData = ['user_name' => 'john_doe', 'email_address' => 'john@example.com'];
$frontendData = [];
foreach ($apiData as $key => $value) {
    $frontendData[CaseConverter::toCamelCase($key)] = $value;
}
// Result: ['userName' => 'john_doe', 'emailAddress' => 'john@example.com']

// Database column to PHP property mapping
class User {
    public function fromDatabase(array $row): void {
        foreach ($row as $column => $value) {
            $property = CaseConverter::toCamelCase($column);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }
}

// Configuration key transformation
$config = [
    'database-host' => 'localhost',
    'cache-driver' => 'redis',
    'mail-smtp-port' => 587
];

$phpConfig = [];
foreach ($config as $key => $value) {
    $phpConfig[CaseConverter::toSnakeCase($key)] = $value;
}
// Result: ['database_host' => 'localhost', 'cache_driver' => 'redis', 'mail_smtp_port' => 587]

// Class name generation
$tableName = 'user_profiles';
$className = CaseConverter::toPascalCase($tableName); // UserProfiles

// URL slug generation
$title = 'My Blog Post Title';
$slug = CaseConverter::toKebabCase($title); // my-blog-post-title
```

### Error Handling

```php
use DevJeetu\CaseConverter\CaseConverter;

try {
    $result = CaseConverter::convert('test', 'invalid_format');
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage(); // "Unsupported format: invalid_format"
}

// Safe checking
if (CaseConverter::isFormatSupported('snake')) {
    $result = CaseConverter::convert('test', 'snake');
} else {
    // Handle unsupported format
}
```

## 📈 Performance

Benchmarks on typical string conversions:

- **~0.001ms** per conversion on average
- **Memory efficient** with minimal allocations
- **Scales linearly** with input string length
- **No external dependencies** - pure PHP implementation

## 🐛 Issues & Support

If you discover any issues or have questions:

1. Check existing [issues](https://github.com/dev-jeetu/case-converter/issues)
2. Open a [new issue](https://github.com/dev-jeetu/case-converter/issues/new) with detailed description
3. For security issues, please email directly

## 📄 License

This project is licensed under the MIT License.

## 🙏 Acknowledgments

- Inspired by various case conversion libraries across different languages
- Built with modern PHP best practices and type safety
- Comprehensive test coverage ensures reliability
- Community feedback and contributions

## 🔄 Changelog

### v1.0.0
- Initial release
- Support for 11 different case formats
- Type-safe enum-based API
- Comprehensive acronym handling
- Full test coverage
- PHP 8.1+ support

---

<div align="center">

**Made with ❤️ by [Jeetu](https://github.com/dev-jeetu)**

[Report Bug](https://github.com/dev-jeetu/case-converter/issues) · [Request Feature](https://github.com/dev-jeetu/case-converter/issues) · [Documentation](https://github.com/dev-jeetu/case-converter/wiki)

</div>