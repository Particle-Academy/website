<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Story;
use App\Models\WaitingList;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Dashboard', [
            'counts' => [
                'waiting_list' => WaitingList::query()->count(),
                'stories' => Story::query()->count(),
                'partners' => Partner::query()->count(),
            ],
        ]);
    }
}
