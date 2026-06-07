<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PartnerController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Partners', [
            'partners' => Partner::query()->orderBy('display_order')->paginate(10),
        ]);
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        Partner::create($request->validated());

        return back()->with('message', 'Partner saved successfully.');
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $partner->update($request->validated());

        return back()->with('message', 'Partner saved successfully.');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        $partner->delete();

        return back()->with('message', 'Partner deleted successfully.');
    }
}
