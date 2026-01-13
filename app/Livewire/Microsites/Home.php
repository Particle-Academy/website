<?php

namespace App\Livewire\Microsites;

use Livewire\Component;

class Home extends Component
{
    public $subdomain;

    public $component;

    protected $layout = 'components.layouts.app'; // Default layout

    protected $microsites = [
        'tribe-trip' => [
            'name' => 'Tribe Trip',
            'component' => 'microsites.tribe-trip.home',
            'layout' => 'components.layouts.tribe-trip',
        ],
        'laravel-fun-labs' => [
            'name' => 'Laravel Fun Lab',
            'component' => 'microsites.laravel-fun-labs.home',
            'layout' => 'components.layouts.laravel-fun-labs',
        ],
        'laravel-catalog' => [
            'name' => 'Laravel Catalog',
            'component' => 'microsites.laravel-catalog.home',
            'layout' => 'components.layouts.laravel-catalog',
        ],
    ];

    public function mount($subdomain = null)
    {
        $this->subdomain = $subdomain;

        if (! array_key_exists($this->subdomain, $this->microsites)) {
            abort(404);
        }

        $config = $this->microsites[$this->subdomain];
        $this->component = $config['component'];
        $this->layout = $config['layout'] ?? 'components.layouts.app';
    }

    public function render()
    {
        return view('livewire.microsites.home')
            ->layout($this->layout);
    }
}
