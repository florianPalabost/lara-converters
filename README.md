# Laravel Converters

May be fork to be used on new laravel project

You may need to create a database file :

```bash
touch database/database.sqlite
```

if not already done you may need to create the .env file & generate the key app

```bash
cp .env.example .env
php artisan key:generate --ansi
```

## Formater / analyzer

-   pint : vendor/bin/pint (--dirty for only modified)
-   larastan : vendor/bin/phpstan
-   rector: vendor/bin/rector process --config=CONFIG (--dry-run) [File(s)]

## Requirements

-   docker compose 2.26

