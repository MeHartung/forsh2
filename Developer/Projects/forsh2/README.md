# Forschungsmittel.com

Symfony 7.3 project for forschungsmittel.com website.

## Requirements

- PHP 8.2+
- Composer

## Installation

```bash
composer install
```

## Development

```bash
php -S localhost:8000 -t public
```

## Deployment on Railway

This project is configured for deployment on Railway.app.

### Environment Variables

Set the following environment variables in Railway:

- `APP_ENV=prod`
- `APP_DEBUG=0`
- `APP_SECRET` - Generate a random secret key
- `DATABASE_URL` - Database connection string (if using database)

Railway will automatically:
- Detect PHP project
- Install dependencies via Composer
- Start the server on the provided PORT

## Project Structure

- `src/` - PHP source code
- `templates/` - Twig templates
- `assets/` - Frontend assets (JS, SCSS)
- `public/` - Web root
- `config/` - Symfony configuration
