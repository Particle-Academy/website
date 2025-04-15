<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        // Get counts for the dashboard
        $waitingListCount = \App\Models\WaitingList::count();
        $storyCount = \App\Models\Story::count();
        $partnerCount = \App\Models\Partner::count();
        
        return view('livewire.admin.dashboard', [
            'waitingListCount' => $waitingListCount,
            'storyCount' => $storyCount,
            'partnerCount' => $partnerCount,
        ]);
    }
}
