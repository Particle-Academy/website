<?php

namespace Tests\Feature\Livewire\Components;

use App\Livewire\Components\HeroUnit;
use Livewire\Livewire;
use Tests\TestCase;

class HeroUnitTest extends TestCase
{
    /** @test */
    public function hero_unit_component_can_be_rendered()
    {
        Livewire::test(HeroUnit::class)
            ->assertStatus(200);
    }

    /** @test */
    public function hero_unit_contains_required_content()
    {
        Livewire::test(HeroUnit::class)
            ->assertSee('Particle Academy')
            ->assertSee('The Community Accelerator')
            ->assertSee('Coming Soon');
    }
}
