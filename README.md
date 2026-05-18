# Aanoukya Avenues - Laravel Website

A full redesign of the Aanoukya Avenues website built with Laravel and Tailwind CSS.

## What is included

- Professional, clean, architecture-focused frontend
- Public pages:
  - Home
  - About
  - Services (listing + detail)
  - Portfolio/Projects (listing + detail with category filter)
  - Contact page with inquiry form
- Admin CMS:
  - Login-protected admin area
  - Dashboard with key metrics
  - CRUD for services, projects, team members, and testimonials
  - Contact inbox with "mark as replied" workflow

## Stack

- Laravel 13
- Blade templates
- Tailwind CSS (v4)
- SQLite by default (easy local setup)

## Local setup

1. Install dependencies

```bash
composer install
npm install
```

2. Create env and app key

```bash
cp .env.example .env
php artisan key:generate
```

3. Create database and run migrations + seeders

```bash
touch database/database.sqlite
php artisan migrate --seed
```

4. Build assets and run app

```bash
npm run build
php artisan serve
```

If you do not have PHP/Composer locally, use Docker for artisan/composer tasks and run frontend commands with Node.

## Admin access (seeded)

- URL: `/admin/login`
- Email: `admin@aanoukyaavenues.com`
- Password: `password`

Change this password immediately for non-local environments.

## Useful commands

```bash
php artisan migrate:fresh --seed
php artisan test
npm run dev
npm run build
```

## Notes

- Portfolio images are seeded as external URLs.
- Contact form submissions are stored in `contact_submissions` and visible in admin inbox.
- Public copy and seeded content can be edited from the admin panel.
