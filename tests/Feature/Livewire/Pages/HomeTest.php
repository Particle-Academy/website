<?php

namespace Tests\Feature\Livewire\Pages;

use App\Livewire\Pages\Home;
use App\Livewire\Components\HeroUnit;
use App\Livewire\Components\WaitingList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /** @test */
    public function home_page_can_be_rendered()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function home_page_contains_hero_unit_component()
    {
        Livewire::test(Home::class)
            ->assertSeeLivewire(HeroUnit::class);
    }

    /** @test */
    public function home_page_contains_waiting_list_component()
    {
        Livewire::test(Home::class)
            ->assertSeeLivewire(WaitingList::class);
    }
}
