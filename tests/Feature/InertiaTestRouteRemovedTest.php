<?php

/*
 * `/_inertia-test` was a throwaway route from the Inertia migration (see
 * _docs/refactor-plan.md, Phase 0): it rendered a demo page to prove the
 * Inertia + Fancy UI plumbing worked, and was meant to be deleted once a real
 * page had been migrated. Every page has been migrated since, and the route was
 * still publicly reachable in production.
 */

test('the temporary inertia verification route is gone', function () {
    $this->get('/_inertia-test')->assertNotFound();
});

test('the page component that only the verification route rendered is gone', function () {
    expect(resource_path('js/Pages/Test.tsx'))->not->toBeFile();
});
