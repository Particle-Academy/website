<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    /**
     * Log the user out of the application.
     */
    public function logout()
    {
        Auth::logout();
        
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.auth.logout');
    }
}
