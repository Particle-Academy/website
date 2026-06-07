# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Particle Academy marketing site — Laravel + Inertia + React + Tailwind v4. Multi-tenant via subdomain routing for microsites (Tribe Trip, Laravel Fun Lab, Laravel Catalog). All public pages, microsites, login, and admin are Inertia-rendered React components built from `@particle-academy/react-fancy` ("Fancy UI"). Livewire and Flux UI have been fully removed.

## Commands

- `composer run dev` — runs `php artisan serve`, `queue:listen`, `pail` (logs), and `npm run dev` concurrently. Client-side rendering only (no SSR).
- `composer run dev:ssr` — same as `dev` plus `php artisan inertia:start-ssr` (Node SSR on port 13714). Use when working on SSR-specific behavior.
- `npm run build` — builds **both** client and SSR bundles. The SSR bundle lands in `bootstrap/ssr/ssr.js`. **Vite manifest errors** mean you need to run this (or `npm run dev`).
- `npm run build:client` / `npm run build:ssr` — build one bundle at a time.
- `vendor/bin/pint --dirty` — format changed files. Run before finalizing edits. Don't use `--test`.
- `php artisan test --compact` — run all Pest tests.
- `php artisan test --compact tests/Feature/SubdomainTest.php` — single file.
- `php artisan test --compact --filter=testName` — single test.
- `php artisan make:test --pest {Name}` — feature test by default; add `--unit` for unit.

## Architecture

**Pages are Inertia-rendered React components**, not controllers and not Livewire. Routes hit either a closure that returns `Inertia::render('PageName', [...props])` or a controller method that returns the same. Static-content pages (privacy, terms, sponsors) use closures; data/form pages (`/`, admin CRUD, `/login`) use controllers in `app/Http/Controllers/` (admin lives under `Admin/` sub-namespace; auth under `Auth/`).

**Routing is split by host** in `routes/web.php`. The app URL host (parsed from `config('app.url')`) handles main-site routes; any `{subdomain}.<host>` falls through to a closure that maps the subdomain to a `Microsites/{Slug}` Inertia page using an in-route allowlist (`tribe-trip`, `laravel-fun-labs`, `laravel-catalog`), 404s on miss. Adding a microsite means: add the slug to that map and create `resources/js/Pages/Microsites/{Slug}.tsx` with its own inline header/footer. Local subdomain testing requires `*.<host>` resolving (Herd via local domains; otherwise hosts file or `.test` TLD).

**React entry + app shell** live in `resources/js/app.tsx` (client) and `resources/js/ssr.tsx` (server). Both wrap the Inertia outlet in `<FancyAppRoot withScreens={false} withECharts={false}>` then `<FancyDataRoot>` (fancy-query — TanStack Query + Inertia hydration). The Inertia root template is `resources/views/app.blade.php`. Page components live under `resources/js/Pages/` (PSR-style folder names — `Pages/Auth/Login.tsx`, `Pages/Admin/Stories.tsx`, etc.). Shared layouts (`PublicLayout` / `Layout`, `AdminLayout`, `GuestLayout`) live in `resources/js/Layouts/`; cross-page React components live in `resources/js/Components/` and `resources/js/Components/Admin/`.

**Inertia shared props** are set in `app/Http/Middleware/HandleInertiaRequests.php`: `appUrl`, `auth.user`, `flash.message`, `flash.error`, `errors`. Access on the client via `usePage().props`.

**Forms** use `@inertiajs/react`'s `useForm()` posting to a controller method that accepts a Form Request (see `app/Http/Requests/`). Validation errors flow back through Inertia's shared `errors` automatically. The home/coaches/partners/sponsors-style "waiting list" form posts to `WaitingListController::store`; admin CRUD pages use one Form Request per model.

**SSR** is opt-in via `INERTIA_SSR_ENABLED` (default `false` in `.env`). Build the SSR bundle (`npm run build:ssr`), start the Node server (`php artisan inertia:start-ssr`), flip the env to `true`, and Inertia will server-render before hydration. For production deploy, run `inertia:start-ssr` under Supervisor (or Octane) and set `INERTIA_SSR_ENABLED=true`. The fancy-inertia SSR-safety matrix (`node_modules/@particle-academy/fancy-inertia/docs/SSR.md`) lists which components need `<FancyClientOnly>` — react-fancy's overlays self-guard, so only fancy-echarts/fancy-3d/file-upload need wrapping (none of which we currently use).

**Laravel 12+ layout reminders**: middleware/exceptions/routing live in `bootstrap/app.php` (no `Http/Kernel.php`); console commands in `app/Console/Commands/` auto-register; service providers in `bootstrap/providers.php`. `HandleInertiaRequests` middleware is appended to the `web` group. Admin routes are gated by the `auth` + `admin` aliases (the latter mapped to `App\Http\Middleware\AdminMiddleware`). Default DB is SQLite (`database/database.sqlite`); tests run against `:memory:` SQLite per `phpunit.xml`.

## Stack rules

Stack: Laravel + Inertia 3 + React 19 + Tailwind v4 + Pest 4 + PHP 8.4. Highlights that bite quickly:

- **No Livewire / Flux** — both are uninstalled. Don't reintroduce. Page-level interactivity is React + Inertia; styling is Tailwind + the custom `particle-*` utilities in `resources/css/app.css`.
- **React-fancy components** — bundled via `@particle-academy/react-fancy` (Tailwind v4 `@source` directive in `app.css` scans the dist). `Action` is a deprecated alias of `Button`; prefer `Button` in new code.
- **Inertia testing** — use `assertInertia(fn ($page) => $page->component('Foo')->where('prop', ...))`. Bare `assertSee('Text')` will fail unless SSR is on, because page content lives in the `data-page` JSON, not the initial HTML.
- **Tailwind v4** is CSS-first via `@theme` (no `tailwind.config.js`); use `@import "tailwindcss"` not `@tailwind` directives; prefer `bg-black/50` over deprecated `bg-opacity-*`; use `gap-*` not margins for list spacing.
- **PHP 8.4**: explicit return types on all methods; constructor property promotion; PHPDoc over inline comments; never `env()` outside config files (use `config(...)`); prefer `Model::query()` over `DB::`; eager load to avoid N+1.
- **Pest 4**: tests in `tests/Feature` and `tests/Unit`; browser tests in `tests/Browser/`; use specific assertions (`assertForbidden`, `assertSuccessful`) not `assertStatus(...)`. **Never delete tests without approval.**

## External tooling (MCP)

Configured in `.mcp.json`. Their full guidelines are intentionally **not** inlined here.

- **Tynn** (project management): read the `tynn-guidelines` MCP resource for its tool reference and workflow rules — the server's own instructions point you there.
- **Laravel Boost** (`php artisan boost:mcp`): `search-docs`, `tinker`, `database-query`, `browser-logs`, `get-absolute-url`, `list-artisan-commands`. Use `search-docs` for version-specific Laravel-ecosystem docs.
- **Fancy UI registry** (`plugin:fancy-ui:fancy-ui`): `list-components`, `search-components`, `get-component`, `install-instructions`. Use this when looking up components from the broader Fancy UI suite (react-fancy + companion packages on `ui.particle.academy`).
