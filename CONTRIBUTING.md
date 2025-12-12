# Contributing to YNAB SDK for Laravel

Thank you for your interest in contributing to the YNAB SDK for Laravel! We appreciate your time and effort in helping improve this package. This document provides guidelines and instructions for contributing to the project.

## Code of Conduct

We are committed to providing a welcoming and inclusive environment for everyone. By participating in this project, you agree to treat all contributors with respect and professionalism. We expect all contributors to:

- Be respectful and considerate in all interactions
- Accept constructive criticism gracefully
- Focus on what is best for the community
- Show empathy towards other community members

## How to Contribute

There are many ways you can contribute to this project:

### Reporting Bugs

If you find a bug, please create an issue on GitHub with:

- A clear and descriptive title
- Steps to reproduce the issue
- Expected behavior
- Actual behavior
- Your environment (PHP version, Laravel version, package version)
- Any relevant code samples or error messages

### Suggesting Features

We welcome feature suggestions! Please create an issue with:

- A clear and descriptive title
- A detailed description of the proposed feature
- Use cases and benefits
- Any implementation ideas (optional)

### Code Contributions

We welcome code contributions through pull requests! Please follow the guidelines below to ensure a smooth review process.

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Git

### Fork and Clone

1. Fork the repository on GitHub
2. Clone your fork locally:

```bash
git clone https://github.com/YOUR-USERNAME/ynab-sdk-laravel.git
cd ynab-sdk-laravel
```

3. Add the upstream repository:

```bash
git remote add upstream https://github.com/danielh-official/ynab-sdk-laravel.git
```

### Install Dependencies

Install the project dependencies using Composer:

```bash
composer install
```

### Setup for Testing

The project uses [Pest PHP](https://pestphp.com/) for testing. After installing dependencies, you're ready to run tests:

```bash
composer test
```

## Development Workflow

### 1. Create a Feature Branch

Always create a new branch for your work:

```bash
git checkout -b feature/your-feature-name
# or
git checkout -b fix/your-bug-fix
```

Use descriptive branch names:
- `feature/` for new features
- `fix/` for bug fixes
- `docs/` for documentation changes
- `refactor/` for code refactoring

### 2. Make Your Changes

- Write clean, readable code
- Follow the existing code style and conventions
- Keep changes focused and atomic
- Add comments where necessary to explain complex logic

### 3. Write/Update Tests

- Add tests for new features
- Update existing tests if you modify functionality
- Ensure all tests pass before submitting your PR
- Aim for good test coverage

Run tests with:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

### 4. Ensure Code Quality

#### Code Style

This project uses [Laravel Pint](https://laravel.com/docs/pint) for code formatting. Before committing, format your code:

```bash
composer format
```

To check for style issues without fixing them:

```bash
composer lint
```

#### Static Analysis

This project uses [PHPStan](https://phpstan.org/) (via Larastan) for static analysis. Run the analysis:

```bash
composer analyse
```

Ensure your code passes static analysis at the configured level (currently level 5).

### 5. Commit Your Changes

Write clear, descriptive commit messages following these guidelines:

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Start with a capital letter
- Keep the first line under 72 characters
- Add a blank line after the first line, then provide more details if needed

Examples:
```
Add support for transaction creation

This commit adds the ability to create new transactions
through the SDK with proper validation and error handling.
```

```
Fix budget retrieval error handling

Properly handle API errors when retrieving budget data
and provide meaningful error messages to users.
```

### 6. Keep Your Branch Up to Date

Regularly sync your branch with the upstream repository:

```bash
git fetch upstream
git rebase upstream/main
```

## Testing

This project uses Pest PHP for testing. Tests are located in the `tests/` directory.

### Running Tests

Run all tests:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

Run specific test files:

```bash
vendor/bin/pest tests/YourTestFile.php
```

### Writing Tests

- Follow the existing test patterns in the project
- Use descriptive test names that explain what is being tested
- Use Pest's expressive syntax for better readability
- Group related tests using `describe()` blocks when appropriate

Example:
```php
test('it can retrieve a budget', function () {
    // Arrange
    $budgetId = 'test-budget-id';
    
    // Act
    $budget = Ynab::budgets()->get($budgetId);
    
    // Assert
    expect($budget)->toBeInstanceOf(Budget::class);
});
```

## Pull Request Process

1. **Ensure all tests pass**: Run `composer test` and fix any failing tests
2. **Ensure code quality checks pass**: 
   - Run `composer format` to format your code
   - Run `composer analyse` and fix any issues
3. **Update documentation**: Update the README.md or Wiki if your changes affect usage
4. **Update the CHANGELOG**: Add an entry under the "Unreleased" section following the [Keep a Changelog](https://keepachangelog.com/) format
5. **Link related issues**: Reference any related issues in your PR description (e.g., "Fixes #123")
6. **Provide a clear PR description**:
   - Describe what changes you made and why
   - Include any breaking changes
   - Add screenshots if applicable
7. **Request a review**: Once your PR is ready, request a review from a maintainer

### PR Title Guidelines

Use clear, descriptive PR titles:
- Start with a verb in the present tense
- Be specific about what the PR does
- Examples: "Add budget creation endpoint", "Fix error handling in transactions"

### What to Expect

- A maintainer will review your PR as soon as possible
- You may be asked to make changes or provide additional information
- Once approved, a maintainer will merge your PR
- Your contribution will be included in the next release

## Coding Standards

This project follows PHP and Laravel best practices:

### PHP Standards

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style standard
- Code formatting is enforced using Laravel Pint
- Static analysis is performed using PHPStan at level 5

### Laravel Conventions

- Follow [Laravel coding conventions](https://laravel.com/docs/contributions#coding-style)
- Use Laravel's helper functions and facades appropriately
- Follow the framework's architectural patterns

### Package-Specific Guidelines

- Use type hints for all method parameters and return types
- Write clear DocBlocks for public methods
- Keep methods focused and single-purpose
- Use meaningful variable and method names
- Avoid unnecessary complexity

## Questions and Support

If you have questions or need help:

- **General questions**: Open a [GitHub Discussion](https://github.com/danielh-official/ynab-sdk-laravel/discussions)
- **Bug reports**: Open an [Issue](https://github.com/danielh-official/ynab-sdk-laravel/issues)
- **Security vulnerabilities**: Please review [our security policy](https://github.com/danielh-official/ynab-sdk-laravel/security/policy)

## License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

---

Thank you again for your contribution! We look forward to working with you. 🎉
