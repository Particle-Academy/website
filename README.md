# Particle Academy — Website

The public website for **Particle Academy** — the community-support and human-development arm of the **Civicognita** family and the **Impactivism** movement.

## About Particle Academy

Particle Academy helps people **become the best human they can be by learning to use every tool — starting with their own mind and body, and the work they produce.** It delivers community support services across three pillars:

- **Career building** — practical skills and pathways to meaningful work.
- **Wellness training** — mastering mind and body as the first and most important tools.
- **Entrepreneurship evangelism** — inspiring people to create value and build.

Digital today, Particle Academy is working toward a physical **entrepreneurship center**. As part of Civicognita, its mission ladders up to **Impactivism** — the movement for an economy where *impact*, not profit, is the primary unit of value.

## Tech stack

- **Laravel 12** (PHP 8.4) with **Inertia.js** and Ziggy
- **React 19 + TypeScript**, bundled with **Vite**
- **Tailwind CSS v4**
- Built on the **Fancy UI** kit — Fancy Core (`@particle-academy/react-fancy`, `@particle-academy/fancy-inertia`, `@particle-academy/fancy-query`) with **TanStack Query**

Fancy UI is itself a Particle Academy project, so this site is built with the design system it stewards.

## Getting started

**Requirements:** PHP 8.4+, Composer, Node 20+, and a database (SQLite works out of the box).

```bash
# Install dependencies
composer install
npm install

# Set up the environment
cp .env.example .env
php artisan key:generate
php artisan migrate

# Run the app — Laravel, queue, and Vite together
composer run dev
```

Prefer separate processes? Run `php artisan serve` and `npm run dev` in two terminals. The app serves at http://localhost:8000.

## Project structure

A standard Laravel layout. The front end (React + Inertia pages and components) lives in `resources/` and compiles through Vite; server routes are in `routes/`. Supporting docs are in `_docs/`, and `CLAUDE.md` carries conventions for AI-assisted development.

## The ecosystem

Particle Academy is one of the entities under **Civicognita**, the non-profit steward of Impactivism, alongside **Renaissance Analytics** (its for-profit product arm) and **Wish's Wonders**.

---

*© Particle Academy — part of the Civicognita family.*
