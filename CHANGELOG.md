# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
### Added
- **CI** (`.github/workflows/ci.yml`): the org's third-party dependency allowlist gate, plus type-check, both Vite bundles and the Pest suite on every push to `main` and every pull request. The site previously had no workflows, so nothing checked any of it.
- **No MCP secret files** (`.github/workflows/no-mcp-secrets.yml`): rejects a push or pull request that tracks an `mcp.json` config, which routinely holds API tokens.

### Removed
- **Ziggy** (`tightenco/ziggy`) and the `@routes` directive in `resources/views/app.blade.php`. Nothing read it: every page builds its URLs as literal paths (`form.post("/waiting-list")`, `router.delete(\`/admin/partners/${id}\`)`), no TS/TSX calls `route()`, neither built bundle mentions `Ziggy`, and `HandleInertiaRequests::share` has no `ziggy` key. The only `route()` calls left are Laravel's own PHP helper in `AuthenticatedSessionController`. The directive was not harmless, either: it printed every route name and URI into each public page, including the whole `admin.*` group. It was also an unapproved third-party dependency, which failed the allowlist job.

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

