<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaitingListRequest;
use App\Models\WaitingList;
use Illuminate\Http\RedirectResponse;

class WaitingListController extends Controller
{
    public function store(WaitingListRequest $request): RedirectResponse
    {
        WaitingList::create($request->validated());

        return back()->with('message', 'Thank you for joining our waiting list!');
    }
}
