# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

D&D 3.5 character sheet builder. Stack: Laravel 10 + Vue 3 + Inertia.js + Vuetify 4 + Tailwind CSS 4. Admin panel via Filament 3. Database: PostgreSQL 15.

## Commands

```bash
# Frontend
npm run dev          # Vite dev server (port 5173)
npm run build        # Production build

# Backend
php artisan serve    # Laravel dev server
php artisan migrate
php artisan db:seed

# Tests
php vendor/bin/phpunit                              # All tests
php vendor/bin/phpunit --filter FichaTest           # Single test class
php vendor/bin/phpunit tests/Feature/FichaTest.php  # Single file

# Code style
php vendor/bin/pint
```

Tests use SQLite in-memory (`:memory:`) — no database setup needed for testing.

## Architecture

**Request flow:** `routes/web.php` → Controller → `Inertia::render('Page/Name', $props)` → Vue SFC receives props.

**Backend** (`app/`):
- `Models/` — 13 Eloquent models. `Ficha` is the central model (character sheet) with 69 fillable fields and relationships to `Raca`, `Classe`, `Tendencia`, plus many-to-many to `Pericia`, `Arma`, `Armadura`, `Equipamento`.
- `Http/Controllers/` — 12 RESTful controllers, one per entity.
- `Filament/Resources/` — Admin CRUD at `/admin` for game data management.

**Frontend** (`resources/js/`):
- `app.js` — bootstraps Vue 3 + Inertia + Vuetify with custom medieval theme.
- `Pages/` — Inertia page components (one per route group: `Fichas/`, `Classes/`, `Magias/`, etc.).
- `Layouts/AppLayout.vue` — shared layout injected by Inertia middleware.

**Database** (`database/`):
- 25 migrations, 9 seeders with actual D&D 3.5 data (classes, races, spells, items).
- 9 factories for tests.

## Key Conventions

- Controllers return `Inertia::render()` for pages and `redirect()->back()` / `redirect()->route()` for mutations — no JSON responses on web routes.
- Pivot tables for many-to-many: `ficha_pericia` (with `graduacoes`), `ficha_arma`, `ficha_armadura`, `ficha_equipamento`, `classe_magia` (spell level per class).
- Vuetify components use the custom theme (`parchment`, `blood-red`, `magic-purple`) defined in `app.js`.
- Tailwind is used alongside Vuetify — utility classes for layout, Vuetify components for UI elements.
- API auth via Laravel Sanctum (`routes/api.php`). Web routes are session-based.
