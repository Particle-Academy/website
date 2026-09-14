# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
### Added
- **CI** (`.github/workflows/ci.yml`): the org's third-party dependency allowlist gate, plus type-check, both Vite bundles and the Pest suite on every push to `main` and every pull request. The site previously had no workflows, so nothing checked any of it.
- **Pint style check in CI** (`vendor/bin/pint --test`, after the tests). Pint was already a dev dependency but nothing ran it, and eleven PHP files had drifted; they were formatted in a commit of their own.
- **No MCP secret files** (`.github/workflows/no-mcp-secrets.yml`): rejects a push or pull request that tracks an `mcp.json` config, which routinely holds API tokens.

### Changed
- **`@particle-academy/react-fancy` 5.15.0 → 5.26.0.** The one breaking entry in that span is 5.17.0's "`Field` no longer spaces itself"; every place this site stacks two or more `Field`s already sits in a `space-y-4` form or a `grid gap-4` row, so no markup changed. It also fixes the admin modals: the right-hand field of each two-column row (Role, Rating, Display order) had been sitting 16px below its neighbour, which is exactly the defect 5.17.0 describes. Measured in a browser before and after. The update also drops `clsx` from the installed tree (5.22.0 inlined it).
- **Retired `Action` alias replaced with `Button`** in all 28 places it was still rendered: the three admin CRUD pages (page actions, form modals, delete confirmations, the waiting-list interest tags) and the three microsites. `Action` is the same component under its old name, kept by react-fancy only as a deprecated alias a future major removes, so no prop changed. Verified in a browser: the outerHTML of every rendered button, admin modals included, is byte-identical before and after. A source-contract test now fails if a page imports `Action`, `ActionColor` or `ActionProps` from react-fancy, or renders `<Action>`.

### Removed
- **The temporary `/_inertia-test` route** and `resources/js/Pages/Test.tsx`, the demo page it rendered. It was a Phase 0 plumbing check from the Inertia migration, marked "TEMP — delete once another page has been migrated", and it stayed publicly reachable long after every page had been. A feature test now asserts the URL 404s and the page component stays gone.
- **Ziggy** (`tightenco/ziggy`) and the `@routes` directive in `resources/views/app.blade.php`. Nothing read it: every page builds its URLs as literal paths (`form.post("/waiting-list")`, `router.delete(\`/admin/partners/${id}\`)`), no TS/TSX calls `route()`, neither built bundle mentions `Ziggy`, and `HandleInertiaRequests::share` has no `ziggy` key. The only `route()` calls left are Laravel's own PHP helper in `AuthenticatedSessionController`. The directive was not harmless, either: it printed every route name and URI into each public page, including the whole `admin.*` group. It was also an unapproved third-party dependency, which failed the allowlist job.

### Fixed
- **The Geist typeface never loaded, so the whole site rendered in the system font.** `design-tokens.css` requested it with an `@import url(...)` below its opening comment, and once Tailwind inlines that file the import is no longer the first rule, which CSS ignores; the build dropped it with an "`@import` rules must precede all rules" warning. Geist and Geist Mono now load from a `<link>` in `resources/views/app.blade.php`, next to the existing `preconnect`s, and the unused Instrument Sans stylesheet that link used to fetch is gone (no CSS referenced it). Checked in a browser on the home page: before, no Geist `FontFace` existed and text measured identically to the fallback; after, Geist 400/500/600 and Geist Mono 400/600 load from fonts.gstatic.com and headings measure differently from both fallbacks. Expect slightly different line breaks: the home lede now wraps to three lines instead of four. A feature test asserts the `<link>` is in the head and that no stylesheet under `resources/css` `@import`s a remote URL.

### Security
- **The admin seeder no longer contains a password.** `AdminUserSeeder` created the administrator with an email and password typed into the file, in this public repository, since 2025-04-14; anyone who read it could sign in to any deployment seeded with it. The credentials now come from `ADMIN_EMAIL` / `ADMIN_PASSWORD` (`config/admin.php`) with no defaults. Seeding production without both throws before anything is written; outside production an unset password becomes a random one the seeder prints. **Removing the literal does not un-publish it:** it stays readable in the git history, so any account that was ever given that password must have it changed. A test fails if any seeder hashes or assigns a password literal again.
- **`league/commonmark` 2.9.1 → 2.10.1** (GHSA-8rr7-cvq3-gmfh, high: denial of service through distinctly-named attributes in the Attributes extension). It arrives through `laravel/framework`, whose `^2.8.1` already allowed the fix, so only the lockfile moved.
- **`browserslist` 4.28.2 → 4.28.9** (GHSA-73wf-gq98-2v4g, high) and **`baseline-browser-mapping` 2.10.32 → 2.11.23** (GHSA-w5vr-8v7q-w6rv, medium). Both are build-time only, pulled in by `@vitejs/plugin-react` through Babel, and both fixes sat inside the existing ranges. The regenerated lockfile also lists the other platforms' optional `esbuild` / `rollup` binaries that the previous one had dropped, so `npm ci` resolves the same tree on every OS.

## [0.2.0] - 2026-01-12
### Added
- **Subdomain Routing Infrastructure**: Implemented dynamic subdomain routing to support microsites.
- **Tribe Trip Microsite**: Created landing page with features, use cases, and community resource sharing details.
- **Laravel Fun Lab Microsite**: Created landing page with gamification features, code examples, and installation guide.
- **Laravel Catalog Microsite**: Created landing page with product/subscription management features and Stripe integration details.
- **Privacy & Terms Pages**: Added dedicated Privacy Policy and Terms of Service pages.

### Changed
- **Home Page**: Updated main academy homepage to include navigation cards for all microsites.
- **Project Descriptions**: Updated project descriptions across the site to match current positioning.
- **Year References**: Updated copyright and goal years to 2026.

