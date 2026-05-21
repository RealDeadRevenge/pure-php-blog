# PHP Blog

Simple blog system built with pure PHP, MySQL and Smarty.

## Stack

- PHP 8.3
- MySQL 8
- Smarty
- Docker
- SCSS/CSS

---

## Features

- Categories and articles
- Related articles
- Article view counter
- Sorting by:
    - publication date
    - views
- Pagination
- Database migrations
- Rollback support
- Database seeders
- Docker environment

---

## Project Structure

```txt
project/
├── app/
├── config/
├── database/
├── public/
├── routes/
├── storage/
└── templates/
```

## Environment Files

Root `.env`
- Docker environment configuration

`project/.env`
- PHP application configuration

---

## Installation

### Clone repository

```bash
git clone https://github.com/RealDeadRevenge/pure-php-blog
```

### Start containers

```bash
docker compose up -d --build
```

### Install dependencies

```bash
docker compose exec php composer install
```

### Run migrations

```bash
docker compose exec php php database/migrate.php
```

### Run seeders

```bash
docker compose exec php php database/seed.php
```

## Rollback migrations

```bash
docker compose exec php php database/rollback.php
```

---

## Available Routes

### Home page

```txt
/
```

### Category page

```txt
/category?id=1
```

### Category sorting

```txt
/category?id=1&sort=date
/category?id=1&sort=views
```

### Pagination

```txt
/category?id=1&page=2
```

### Article page

```txt
/article?id=1
```

---

## SCSS

SCSS source files:

```txt
public/assets/scss
```

Compiled CSS:

```txt
public/assets/css
```

---

## AI Usage

AI was used for:
- architecture discussions
- code review
- debugging
- project structure improvements

All implementation decisions and final integration were completed manually.