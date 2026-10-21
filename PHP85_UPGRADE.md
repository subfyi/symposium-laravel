# PHP 8.5 Upgrade

The application targets PHP 8.5 and Laravel 12. Composer 2.2 or newer is required.
Use the committed `composer.lock` when deploying; do not run `composer update` on the server.

## Installation

```bash
composer install --no-dev --optimize-autoloader
composer check-platform-reqs
php artisan optimize:clear
php artisan --version
```

Point the web server at `public/` and select PHP 8.5 for its FPM pool as well as CLI.
The repository's `.php-version` records the local runtime requirement.

## Existing Configuration and Data

- Preserve the existing production `.env`, `APP_KEY`, `storage/oauth-*.key`, OAuth clients and database.
- `MAIL_MAILER` replaces `MAIL_DRIVER`; the old variable remains supported as a fallback.
- Use `QUEUE_CONNECTION` instead of `QUEUE_DRIVER`.
- Analytics now uses GA4: set `ANALYTICS_PROPERTY_ID` instead of the old Universal Analytics view ID if this integration is used.
- Newsletter retains the existing `MAILCHIMP_APIKEY` and `MAILCHIMP_LIST_ID` variables.
- Passport's `/oauth/token` password grant remains enabled. Existing client IDs and secrets are retained.
- Passport migrations are now in `database/migrations`, as required by Passport 12. Existing databases must already record these migration names before running migrations; review `php artisan migrate:status` against a backup or staging copy first.
- Google Drive remains optional and uses a Flysystem 3 adapter with ID-based paths, matching the existing stored file IDs. No live Google Drive requests were tested.

No production database migrations, server configuration changes or deployment were performed during this upgrade.

## Verification

```bash
composer install
php vendor/bin/phpunit --display-all-issues
```

The compatibility suite covers routing, CORS, local stream uploads, GD image decoding/resizing, mail rendering and OAuth password-grant token issuance. OAuth tests use an in-memory SQLite database and temporary in-memory RSA keys.
Production MySQL data and external SMTP, Mailchimp, Google Drive and Analytics credentials need staging verification.
