# Security Policy

## Supported Versions

We take security seriously and provide security updates for the following versions of YNAB SDK for Laravel:

| Version | Supported          |
| ------- | ------------------ |
| 1.1.x   | :white_check_mark: |
| 1.0.x   | :x:                |
| < 1.0   | :x:                |

We recommend always using the latest version of the package to ensure you have the latest security patches and improvements.

## Reporting a Vulnerability

We appreciate your efforts to responsibly disclose your findings and will make every effort to acknowledge your contributions.

### Where to Report

**Please do not report security vulnerabilities through public GitHub issues.**

Instead, please report security vulnerabilities using one of the following methods:

1. **GitHub Security Advisories** (Preferred): Report vulnerabilities privately through [GitHub Security Advisories](https://github.com/danielh-official/ynab-sdk-laravel/security/advisories/new)
2. **Email**: Send an email to the maintainer (see Contact Information below)

### What to Include

To help us better understand and resolve the issue, please include as much of the following information as possible:

- **Type of issue** (e.g., buffer overflow, SQL injection, cross-site scripting, etc.)
- **Full paths of source file(s)** related to the manifestation of the issue
- **Location of the affected source code** (tag/branch/commit or direct URL)
- **Step-by-step instructions** to reproduce the issue
- **Proof-of-concept or exploit code** (if possible)
- **Impact of the issue**, including how an attacker might exploit it
- **Any special configuration** required to reproduce the issue

### Response Timeline

- **Initial Response**: We will acknowledge receipt of your vulnerability report within 48 hours
- **Status Updates**: We will provide regular updates on our progress at least every 7 days
- **Resolution Timeline**: We aim to resolve critical vulnerabilities within 30 days, depending on complexity
- **Disclosure Timeline**: We will coordinate with you on the disclosure timeline after a fix is available

### Process

1. **Report Received**: You submit a vulnerability report
2. **Acknowledgment**: We acknowledge receipt within 48 hours
3. **Investigation**: We investigate and validate the vulnerability
4. **Fix Development**: We develop and test a fix
5. **Release**: We release a patched version
6. **Disclosure**: We publicly disclose the vulnerability after users have had time to update (typically 7-14 days after release)

## Security Best Practices

When using YNAB SDK for Laravel, we recommend following these security best practices:

### Protect Your API Keys and Tokens

- **Never commit** API keys, client secrets, or access tokens to version control
- **Use environment variables** for all sensitive configuration values
- Store your `.env` file securely and never commit it to your repository
- Rotate your API keys and tokens regularly
- Use different credentials for development, staging, and production environments

### Environment Configuration

```bash
# Example .env configuration
YNAB_SDK_LARAVEL_CLIENT_ID=your_client_id_here
YNAB_SDK_LARAVEL_CLIENT_SECRET=your_client_secret_here
```

Always ensure your `.env` file is included in `.gitignore`:

```gitignore
.env
.env.backup
.env.production
```

### Keep Dependencies Up to Date

- **Regularly update** this package to the latest version
- Run `composer update` regularly to get security patches for all dependencies
- Monitor security advisories for Laravel and PHP
- Use `composer audit` to check for known vulnerabilities in your dependencies

```bash
# Check for security vulnerabilities
composer audit

# Update to the latest version
composer update ynab-sdk-laravel/ynab-sdk-laravel
```

### Keep Laravel and PHP Updated

- Use **PHP 8.2 or higher** (as required by this package)
- Keep your **Laravel framework** updated to supported versions (^10.0, ^11.0, or ^12.0)
- Enable security features in your Laravel application (CSRF protection, XSS protection, etc.)
- Follow Laravel's [security best practices](https://laravel.com/docs/security)

### Secure OAuth Implementation

- Implement proper **state parameter validation** in OAuth flows to prevent CSRF attacks
- Use **HTTPS only** in production for OAuth callbacks
- Validate redirect URIs to prevent open redirect vulnerabilities
- Store OAuth tokens securely (encrypted in database or secure session storage)

### Additional Recommendations

- Enable **Laravel's rate limiting** to prevent abuse
- Implement proper **error handling** to avoid exposing sensitive information in error messages
- Use **HTTPS** for all production environments
- Keep your server and hosting environment updated and secure
- Implement proper **logging and monitoring** to detect suspicious activities

## Disclosure Policy

When we receive a security vulnerability report:

1. **Confidentiality**: We will keep the vulnerability details confidential until a fix is released
2. **Fix Development**: We will work to develop, test, and release a fix as quickly as possible
3. **Advisory Publication**: After releasing a fix, we will publish a security advisory on GitHub
4. **Credit**: We will credit the reporter in the security advisory (unless they prefer to remain anonymous)
5. **Notification**: We will notify users through:
   - GitHub Security Advisories
   - Release notes in the CHANGELOG
   - The package's README (if critical)

### Public Disclosure Timeline

- **Immediate**: Publish patched version
- **7-14 days after patch**: Publish detailed security advisory allowing time for users to update
- **Credit**: Publicly acknowledge the security researcher who reported the issue (with their permission)

## Contact Information

### Security Contact

For security-related concerns, please contact:

- **Maintainer**: Daniel Haven
- **GitHub**: [@danielh-official](https://github.com/danielh-official)
- **Report via**: [GitHub Security Advisories](https://github.com/danielh-official/ynab-sdk-laravel/security/advisories/new) (preferred)

### General Support

For general questions and support (non-security issues):

- Open an issue on [GitHub Issues](https://github.com/danielh-official/ynab-sdk-laravel/issues)
- Check the [Wiki](https://github.com/danielh-official/ynab-sdk-laravel/wiki) for documentation

## Security Hall of Fame

We appreciate the following security researchers who have responsibly disclosed vulnerabilities:

*No vulnerabilities have been reported yet.*

---

Thank you for helping keep YNAB SDK for Laravel and its users safe!
