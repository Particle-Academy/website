<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Partners extends Component
{
    public $name;
    public $website;
    public $description;
    public $logo_path;
    public $display_order = 0;
    public $is_published = true;
    
    public $editingPartnerId = null;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $deleteId = null;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'website' => 'nullable|url|max:255',
        'description' => 'nullable|string',
        'logo_path' => 'nullable|string|max:255',
        'display_order' => 'required|integer|min:0',
        'is_published' => 'boolean',
    ];
    
    public function render()
    {
        $partners = \App\Models\Partner::orderBy('display_order')->paginate(10);
        
        return view('livewire.admin.partners', [
            'partners' => $partners,
        ]);
    }
    
    public function edit($id)
    {
        $this->resetValidation();
        $this->isEditing = true;
        $this->editingPartnerId = $id;
        
        $partner = \App\Models\Partner::findOrFail($id);
        $this->name = $partner->name;
        $this->website = $partner->website;
        $this->description = $partner->description;
        $this->logo_path = $partner->logo_path;
        $this->display_order = $partner->display_order;
        $this->is_published = $partner->is_published;
    }
    
    public function save()
    {
        $this->validate();
        
        \App\Models\Partner::updateOrCreate(
            ['id' => $this->editingPartnerId],
            [
                'name' => $this->name,
                'website' => $this->website,
                'description' => $this->description,
                'logo_path' => $this->logo_path,
                'display_order' => $this->display_order,
                'is_published' => $this->is_published,
            ]
        );
        
        $this->reset(['name', 'website', 'description', 'logo_path', 'display_order', 'is_published', 'editingPartnerId', 'isEditing']);
        session()->flash('message', 'Partner saved successfully.');
    }
    
    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->deleteId = $id;
    }
    
    public function delete()
    {
        \App\Models\Partner::findOrFail($this->deleteId)->delete();
        $this->reset(['confirmingDelete', 'deleteId']);
        session()->flash('message', 'Partner deleted successfully.');
    }
    
    public function cancel()
    {
        $this->reset(['name', 'website', 'description', 'logo_path', 'display_order', 'is_published', 'editingPartnerId', 'isEditing', 'confirmingDelete', 'deleteId']);
        $this->resetValidation();
    }
}
