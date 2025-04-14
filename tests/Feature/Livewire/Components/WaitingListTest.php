<?php

namespace Tests\Feature\Livewire\Components;

use App\Livewire\Components\WaitingList;
use Livewire\Livewire;
use Tests\TestCase;

class WaitingListTest extends TestCase
{
    /** @test */
    public function waiting_list_component_can_be_rendered()
    {
        Livewire::test(WaitingList::class)
            ->assertStatus(200);
    }

    /** @test */
    public function waiting_list_contains_form_elements()
    {
        Livewire::test(WaitingList::class)
            ->assertSee('Join Our Waiting List')
            ->assertSee('name')
            ->assertSee('email');
    }

    /** @test */
    public function waiting_list_displays_validation_errors_for_empty_submission()
    {
        Livewire::test(WaitingList::class)
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'interest']);
    }
    
    /** @test */
    public function waiting_list_can_submit_valid_data()
    {
        Livewire::test(WaitingList::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('interest', ['The Accelerator Program'])
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSessionHas('message', 'Thank you for joining our waiting list!');
    }
}
