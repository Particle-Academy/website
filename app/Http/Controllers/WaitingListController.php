<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaitingListRequest;
use App\Models\WaitingList;
use Illuminate\Http\RedirectResponse;

class WaitingListController extends Controller
{
    public function store(WaitingListRequest $request): RedirectResponse
    {
        $email = $request->validated('email');

        WaitingList::create([
            'name' => $request->validated('name') ?? explode('@', $email)[0],
            'email' => $email,
            'interest' => $request->validated('interest') ?? [],
        ]);

        return back()->with('message', "You're on the list — we'll be in touch.");
    }
}
