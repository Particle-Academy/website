<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoryRequest;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class StoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Stories', [
            'stories' => Story::query()->latest()->paginate(10),
        ]);
    }

    public function store(StoryRequest $request): RedirectResponse
    {
        Story::create($request->validated());

        return back()->with('message', 'Success Story saved successfully.');
    }

    public function update(StoryRequest $request, Story $story): RedirectResponse
    {
        $story->update($request->validated());

        return back()->with('message', 'Success Story saved successfully.');
    }

    public function destroy(Story $story): RedirectResponse
    {
        $story->delete();

        return back()->with('message', 'Success Story deleted successfully.');
    }
}
