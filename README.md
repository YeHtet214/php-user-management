# User Management System

A lightweight PHP MVC app for managing users, roles, features, and permissions.

## Tech Stack

- PHP (CI matrix: 8.0, 8.1, 8.2, 8.3)
- Composer 2
- SQLite (via `pdo_sqlite`)
- Custom MVC structure (no full framework)

## Project Structure

```text
app/
  controllers/      # HTTP controllers
  models/           # Data access and business logic
  views/            # UI templates
core/               # Core framework classes (Router, DB, base Model)
database/
  migrations/       # SQL migrations
  migrate.php       # Migration runner
  seed.php          # Seeder runner
public/
  index.php         # Front controller
  style.css
routes/
  web.php           # Route definitions
```

## Prerequisites

1. PHP 8.0+ installed
2. Composer 2 installed
3. PHP extensions enabled:
- `PDO`
- `pdo_sqlite`
- `sqlite3`

## Local Project Initialization

1. Clone the repository and open it:

```bash
git clone git@github.com:YeHtet214/php-user-management.git
cd userManagementSystem
```

2. Install dependencies:

```bash
composer install
```

3. (Optional) Reset local SQLite files for a clean start:

```bash
# macOS/Linux
rm -f database/database.sqlite database/database.sqlite-shm database/database.sqlite-wal

# Windows PowerShell
Remove-Item database\\database.sqlite,database\\database.sqlite-shm,database\\database.sqlite-wal -ErrorAction SilentlyContinue
```

4. Run migrations:

```bash
php database/migrate.php
```

5. Seed initial data:

```bash
php database/seed.php
```

6. Start local server from project root:

```bash
php -S localhost:8000 -t public
```

7. Open in browser:

- `http://localhost:8000/`
- `http://localhost:8000/users`
- `http://localhost:8000/roles`

## Seeded Initial Data

Seeder currently inserts:

- Role: `Admin`
- User: `Jhon` / `example@abc.com`
- Features: `User`, `Product`, `Report`, `Sale`, `Inventory`
- Permissions per feature: `view`, `create`, `update`, `delete`

## Development Commands

Run code style checks:

```bash
vendor/bin/phpcs
```

Run static analysis:

```bash
vendor/bin/phpstan analyse
```

## Troubleshooting

- `Database connection failed: could not find driver`
  - Enable `pdo_sqlite` and `sqlite3` in your PHP installation.
- `404 - Not Found` on valid routes
  - Start server with `-t public` so `public/index.php` is used as front controller.
- SQLite file lock issues
  - Stop all running PHP servers/processes using the DB, then retry.
