<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\WaitingList as WaitingListModel;

class WaitingList extends Component
{
    public $name = '';
    public $email = '';
    public $interest = [];
    
    public $interestOptions = [
        'The Accelerator Program',
        'Internship Opportunity',
        'Learn Martial Arts (Adults/Kids)',
        'Starting a Business',
        'Learning Digital Trades',
        'Mindset Mastery',
        'Supporting our Mission'
    ];
    
    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'interest' => 'required|array|min:1',
        ]);
        
        // Save to the database
        WaitingListModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'interest' => $this->interest,
        ]);
        
        session()->flash('message', 'Thank you for joining our waiting list!');
        
        $this->reset(['name', 'email', 'interest']);
    }
    
    public function render()
    {
        return view('livewire.components.waiting-list');
    }
}
