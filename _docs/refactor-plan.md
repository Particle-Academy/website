# Refactor plan — Livewire → Inertia + React + Fancy UI

## Goal & non-goals

**Goal:** rebuild the public site (and eventually admin) on Laravel + Inertia + React using the **Fancy UI** kit — the same component family Particle Academy ships. Marketing site dogfoods the kit it sells.

**Stays exactly as it is:** Laravel app, Forge deploy, Herd locally, MCP relay broker, microsite subdomain routing, database/models, auth flow.

**Non-goals:** monorepo split, headless API, Next.js, Vercel, SSR (deferred — see Decisions §3).

## What `fancy-inertia` actually gives us (and what it doesn't)

`@particle-academy/fancy-inertia` (v0.2.0) is glue between Fancy UI and Inertia — not generic Inertia. The whole point is that the kit's runtime layers (Toast queue, Screen.System, echarts module registry) are app-shell concerns that need to live ABOVE the Inertia outlet, not in each page. Five exports:

| Export | What it does |
|---|---|
| `<FancyAppRoot>` | One wrapper at the Inertia entry. Mounts `Toast.Provider`, optionally `Screen.System`, optionally registers echarts. Tunable via `withScreens` / `withECharts` flags. |
| `<FancyClientOnly>` | Skip-SSR boundary. Only relevant if/when we turn SSR on. |
| `useFancyForm()` | Wraps Inertia's `useForm()`. Returns `form.field("name")` that drops straight into `<Input>`, `<Select>`, `<Switch>`, etc. Auto-detects event vs raw value. |
| `registerFancyComponents()` | Whitelist of components available to schema-mode pages. Schema-only. |
| `<InertiaSchemaScreen>` | One-line page: `() => <InertiaSchemaScreen />`. Controller emits a layout schema as an Inertia prop; React just renders it. **This is the kit's signature pattern.** |

> **0.2.0 note:** the v0.1.x `usePersistFancyState()` hook is **removed**. fancy-screens 0.4+ uses Zustand directly — if/when we need cross-page state persistence, we'd use Zustand's `persist` middleware, not a fancy-inertia hook. (See `node_modules/@particle-academy/fancy-inertia/docs/Migration.md` if upgrading from 0.1.x patterns.)

### Two page-authoring modes — used together

Pages we'll write fall into one of these:

1. **Standard React page** — `resources/js/Pages/Foo.tsx` with `react-fancy` components inline. Use for marketing/microsite pages with stable, hand-designed layouts (most of the site). Inertia handles routing, props come from `usePage()`, forms use `useFancyForm()`.

2. **Schema-driven page** — controller emits a `fancy-screens` schema as a prop, the React page is one line. Use for surfaces that benefit from server-driven layouts: admin "agent dashboard", live Human+ demos, anything where the agent angle is the point. Requires installing `@particle-academy/fancy-screens` (peer, not yet installed).

**Decision:** start everything in mode 1. Add mode 2 only when a specific page calls for it. Most of the marketing site is hand-designed and doesn't need a schema layer.

## App-shell setup (concrete code per the docs)

```tsx
// resources/js/app.tsx
import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import { FancyAppRoot } from "@particle-academy/fancy-inertia";
import "../css/app.css";

createInertiaApp({
  resolve: (name) => import(`./Pages/${name}.tsx`),
  setup({ App, props, el }) {
    createRoot(el).render(
      <FancyAppRoot withScreens={false} withECharts={false}>
        <App {...props} />
      </FancyAppRoot>
    );
  },
});
```

`withScreens={false}` + `withECharts={false}` initially — those peers aren't installed and the marketing site doesn't need them yet. Flip them on as we add fancy-screens / fancy-echarts.

```css
/* resources/css/app.css */
@import "tailwindcss";
@source "../../node_modules/@particle-academy/react-fancy/dist/**/*.js";
/* @source ".../fancy-screens/..."  ← add when installed */
@import "@particle-academy/react-fancy/styles.css";
```

```blade
{{-- resources/views/app.blade.php — Inertia root template --}}
<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @routes
    @viteReactRefresh
    @vite('resources/js/app.tsx')
    @inertiaHead
</head>
<body class="h-full antialiased">
    @inertia
</body>
</html>
```

`vite.config.js` change: swap (or add alongside) `resources/js/app.js` → `resources/js/app.tsx`. The existing `resources/js/ui-demos.tsx` entry stays during transition (it's what `/ui/demos` uses today) — gets removed at cleanup.

## Phases

Each phase is sized to be one PR. Visual parity is the bar for "done" on each page.

### Phase 0 — Install + wire (no pages migrated)

What's already happened in this session:
- `composer require inertiajs/inertia-laravel` → v3.1.0 installed (composer.json updated).
- `npm install @inertiajs/react @particle-academy/fancy-inertia` → installed.
- `@particle-academy/react-fancy` (3.2.1), `agent-integrations` (0.5.0), `fancy-whiteboard` (0.1.9) already in `package.json`.

Remaining in Phase 0:
1. `php artisan inertia:middleware` → publishes `app/Http/Middleware/HandleInertiaRequests.php`.
2. Append the middleware to the `web` group in `bootstrap/app.php`.
3. Create `resources/views/app.blade.php` (the root template above).
4. Create `resources/js/app.tsx` (the entry above).
5. Update `vite.config.js`: add `resources/js/app.tsx` to inputs. (Leave `resources/js/ui-demos.tsx` for now.)
6. Update `resources/css/app.css` with the `@import "tailwindcss"` + `@source` directive for `react-fancy`.
7. Add a throwaway verification route: `Route::get('/_inertia-test', fn () => Inertia::render('Test'))->name('inertia.test');` rendering a tiny `Pages/Test.tsx` with one `<Action>Hello</Action>`. Confirm visually at `https://particleacademy.test/_inertia-test`. Delete the route and page once confirmed.

Don't touch any existing Livewire pages. They keep working.

**Open question for Phase 0:** decide whether `resources/js/app.js` (current Livewire-friendly entry) gets renamed/deleted, or stays alongside `app.tsx`. Recommendation: keep `app.js` until the last Livewire page is gone — Livewire 3 needs it.

### Phase 1 — Retire `/ui` (Fancy UI now has its own site)

`ui.particle.academy` is the dedicated Fancy UI showcase now. The in-repo `/ui` page is redundant — delete it and replace all links with the external URL.

1. Remove `Route::get('/ui', Ui::class)->name('ui');` from `routes/web.php`.
2. Delete `app/Livewire/Pages/Ui.php` and `resources/views/livewire/pages/ui.blade.php`.
3. Update every `{{ route('ui') }}` reference to `https://ui.particle.academy`:
   - `resources/views/livewire/pages/home.blade.php:53` (the "Explore UI" card)
   - `resources/views/livewire/pages/ui-demos.blade.php` (5 places — topbar, breadcrumb, footer)
   - `resources/views/livewire/pages/ui-demo.blade.php` (3 places — topbar, breadcrumb, back link)
4. Open question: do `/ui/demos` and `/ui/demos/{slug}` also live on `ui.particle.academy` now? If yes, retire them too in this phase. If no, they continue to point users at `https://ui.particle.academy` for the parent context.
5. Update `tests/Feature/PagesTest.php` if it asserts the `/ui` route.

This phase replaces the original "migrate /ui as proof of plumbing." With /ui gone, the throwaway `/_inertia-test` route from Phase 0 is the proof. The first real migrated page becomes `/privacy` or `/terms` in Phase 2.

### Phase 2 — Static marketing pages

`/privacy`, `/terms`, `/coaches`, `/sponsors` — all likely simple, static. One PR per page, same pattern as `/ui`.

For each: read existing Livewire component + Blade view, port markup, delete originals, smoke-test in browser.

### Phase 3 — `/partners` and the home page (form + data)

These have actual data flow:
- `/partners` — pulls partners from the DB. Pass them as Inertia props from a regular controller (`return Inertia::render('Partners', ['partners' => Partner::published()->ordered()->get()])`).
- `/` — has several Livewire sub-components (`HeroUnit`, `KeyFeatures`, `MissionStatement`, `ProgramOverview`, `CommunityEngagement`, `SuccessStories`, `WaitingList`). Most are presentational — flatten them into the Home page or React components. `SuccessStories` consumes stories (controller passes them). `WaitingList` is a form — use `useFancyForm()` per Recipes.md pattern.

The waiting-list form is the first non-trivial interactivity. Reference: Recipes.md → "Server-validated forms with react-fancy fields." Pattern:

```tsx
const form = useFancyForm({ name: "", email: "" });
return (
  <form onSubmit={(e) => { e.preventDefault(); form.post(route("waiting-list.store")); }}>
    <Input {...form.field("name")} placeholder="Name" />
    <Input {...form.field("email")} type="email" placeholder="Email" />
    <Action type="submit" loading={form.processing}>Join</Action>
  </form>
);
```

Server validation errors flow automatically into each `<Input error={...}>` slot. The existing `App\Livewire\Components\WaitingList` validation rules can be copied verbatim into a `WaitingListRequest` form request.

### Phase 4 — `/ui/demos` and `/ui/demos/[slug]`

These are currently Livewire components wrapping iframes of static HTMLs in `public/ui-previews/`. Two paths:

- **Easy:** keep the iframe wrapping; port the Livewire chrome to an Inertia page that does `<iframe src="/ui-previews/...">`. The static HTMLs are already standalone.
- **Better:** replace the iframed previews with real React components from the Fancy UI packages already installed. This is what the Live Demos section of `/ui` advertises ("the fully interactive React versions"). But it's a much bigger lift.

**Recommendation:** ship the easy version first to clear the migration. Upgrade demos to live React in a separate, post-migration project.

### Phase 5 — Microsites

Three subdomain-routed Livewire pages: `tribe-trip`, `laravel-fun-labs`, `laravel-catalog`. Each has a custom layout and a content view.

Migration: `App\Livewire\Microsites\Home` becomes a controller (or route closure) that switches on the subdomain slug and returns `Inertia::render('Microsites/{Slug}', [...])`. Each microsite gets a `Pages/Microsites/TribeTrip.tsx` etc., plus a per-microsite layout component (or just inline the layout markup per page — only 3 pages).

The subdomain routing in `routes/web.php` (lines 22-25) stays unchanged. Update `tests/Feature/SubdomainTest.php` assertions to match the new (identical) rendered content.

### Phase 6 — Login + admin decision

`/login` migrates similar to the waiting-list form (`useFancyForm` + `form.post(route("login"))`).

**Admin (4 pages: Dashboard, Waitinglist, Stories, Partners) — decision pending.** Options:
- **Migrate.** Build Inertia admin pages, drop Livewire/Flux dependency entirely.
- **Keep on Livewire/Flux indefinitely.** Admin is internal, low-traffic, and Flux UI Pro is already paid for. Recommendation: keep until everything else is done, then decide based on appetite.

### Phase 7 — Cleanup

Once all public pages are off Livewire:
1. Remove `resources/js/ui-demos.tsx` from `vite.config.js`; delete the file.
2. Remove the `app.js` entry if `app.tsx` has fully replaced it.
3. If admin migrated: `composer remove livewire/livewire livewire/flux-pro`, remove the `flux-pro` composer repository, delete `app/Livewire/`, `resources/views/livewire/`, `resources/views/flux/`, `resources/views/components/layouts/` (or keep just admin layout if admin stayed).
4. Update CLAUDE.md to remove Livewire/Flux guidance and replace with Inertia + Fancy UI guidance.

## Decisions to lock before each phase

| Decision | Default | Lock by |
|---|---|---|
| **1. SSR on or off?** | **Off** — start with client-only Inertia. Add SSR via `@inertiajs/server` + `php artisan inertia:start-ssr` when SEO requires it (likely never for `/admin`, possibly for marketing if SEO matters more than dev speed). | Phase 0 |
| **2. fancy-screens install?** | **No, defer.** Only needed for schema-driven pages or cross-page persisted state. Add when first page actually needs it. | Per page |
| **3. fancy-echarts install?** | **No, defer.** Add when first chart appears. | Per page |
| **4. Admin migration?** | **Keep on Livewire/Flux** until public site is done, then revisit. | Phase 6 |
| **5. Demo upgrade scope?** | **Iframe-port first.** Real React component upgrades for `/ui/demos/{slug}` are a separate project after migration completes. | Phase 4 |
| **6. Lucide icons source?** | **`@particle-academy/react-fancy/icons`** (the package already ships them). Drop the CDN script in `/ui` view. | Phase 1 |
| **7. Geist fonts?** | Keep Google Fonts CDN as the `/ui` page does, OR self-host via Vite + `@fontsource/geist`. Doesn't block anything. | Phase 1 (or defer) |

## Verification at each phase

- `php artisan test --compact` passes (currently 10 tests).
- Visit migrated page at `https://particleacademy.test/{path}`. No console errors. Visual diff matches.
- Existing untouched Livewire pages still render fine.
- After Phase 5: `php artisan test --compact tests/Feature/SubdomainTest.php` still passes.

## Risks specific to this kit

1. **Tailwind v4 + Fancy UI class scanning.** Tailwind v4 needs `@source` directives to scan node_modules. If we miss the directive, classes inside react-fancy components won't get generated and the components will look broken. Confirmed pattern in Recipes.md.
2. **`vite.config.js` already has both Tailwind v4 and React plugins** — that part of the wiring is already correct (in fact the `/ui/demos` island proves it works).
3. **`fancy-inertia` is v0.1.3** — early version. Watch for API churn if upgrading. Pin the version, don't use `^`.
4. **The `routes/web.php` data-from-Livewire-component pattern** (where `App\Livewire\Pages\Ui` has data methods) needs cleanup as we migrate — extract static data to `app/Data/*` or pass directly from controllers.
