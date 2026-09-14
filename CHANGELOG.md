# Changelog

All notable changes to this project will be documented in this file.

## [Unreleased]
### Added
- **CI** (`.github/workflows/ci.yml`): the org's third-party dependency allowlist gate, plus type-check, both Vite bundles and the Pest suite on every push to `main` and every pull request. The site previously had no workflows, so nothing checked any of it.
- **No MCP secret files** (`.github/workflows/no-mcp-secrets.yml`): rejects a push or pull request that tracks an `mcp.json` config, which routinely holds API tokens.

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

