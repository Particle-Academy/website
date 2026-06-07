<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WaitingListUpdateRequest;
use App\Models\WaitingList;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class WaitingListController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/WaitingList', [
            'waitingLists' => WaitingList::query()->latest()->paginate(10),
        ]);
    }

    public function update(WaitingListUpdateRequest $request, WaitingList $waitingList): RedirectResponse
    {
        $waitingList->update($request->validated());

        return back()->with('message', 'Waiting List Entry saved successfully.');
    }

    public function destroy(WaitingList $waitingList): RedirectResponse
    {
        $waitingList->delete();

        return back()->with('message', 'Waiting List Entry deleted successfully.');
    }
}
