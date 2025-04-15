<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Waitinglist extends Component
{
    public $name;
    public $email;
    public $interest;
    public $contacted;
    public $notes;
    
    public $editingWaitingListId = null;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $deleteId = null;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'interest' => 'nullable|array',
        'contacted' => 'boolean',
        'notes' => 'nullable|string',
    ];
    
    public function render()
    {
        $waitingLists = \App\Models\WaitingList::latest()->paginate(10);
        
        return view('livewire.admin.waitinglist', [
            'waitingLists' => $waitingLists,
        ]);
    }
    
    public function edit($id)
    {
        $this->resetValidation();
        $this->isEditing = true;
        $this->editingWaitingListId = $id;
        
        $waitingList = \App\Models\WaitingList::findOrFail($id);
        $this->name = $waitingList->name;
        $this->email = $waitingList->email;
        $this->interest = $waitingList->interest;
        $this->contacted = $waitingList->contacted;
        $this->notes = $waitingList->notes;
    }
    
    public function save()
    {
        $this->validate();
        
        \App\Models\WaitingList::updateOrCreate(
            ['id' => $this->editingWaitingListId],
            [
                'name' => $this->name,
                'email' => $this->email,
                'interest' => $this->interest,
                'contacted' => $this->contacted,
                'notes' => $this->notes,
            ]
        );
        
        $this->reset(['name', 'email', 'interest', 'contacted', 'notes', 'editingWaitingListId', 'isEditing']);
        session()->flash('message', 'Waiting List Entry saved successfully.');
    }
    
    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }
    
    public function delete()
    {
        \App\Models\WaitingList::findOrFail($this->deleteId)->delete();
        $this->reset(['confirmingDelete', 'deleteId']);
        session()->flash('message', 'Waiting List Entry deleted successfully.');
    }
    
    public function cancel()
    {
        $this->reset(['name', 'email', 'interest', 'contacted', 'notes', 'editingWaitingListId', 'isEditing', 'confirmingDelete', 'deleteId']);
        $this->resetValidation();
    }
}
