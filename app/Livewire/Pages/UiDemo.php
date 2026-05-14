<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class UiDemo extends Component
{
    public string $slug = '';

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $demo = UiDemos::findDemo($slug);
        if (!$demo) {
            abort(404);
        }
    }

    public function render()
    {
        $demo = UiDemos::findDemo($this->slug);

        return view('livewire.pages.ui-demo', [
            'demo' => $demo,
            'relayBaseUrl' => (string) config('mcp.relay_base_url'),
        ]);
    }
}
