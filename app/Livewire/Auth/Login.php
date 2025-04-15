<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    
    public function login()
    {
        $this->validate();
        
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Check if user is admin
            if (Auth::user()->is_admin) {
                session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // Not an admin, logout and show error
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            $this->addError('email', 'These credentials do not have admin access.');
            return;
        }
        
        $this->addError('email', 'These credentials do not match our records.');
    }
    
    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.guest');
    }
}
